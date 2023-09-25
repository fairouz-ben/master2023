<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Speciality;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use App\Rules\IsColumnsUnique;
use Illuminate\Validation\Rule;

use App\Models\SpecialityStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //flash()->addSuccess('Data has been saved successfully!');
        
        $user = User::find(auth()->user()->id);

        $student= Student::where(['user_id'=>Auth::user()->id])->get()->first();
        if( $student)
        {
        
            return view('student.studentHome')->with(['student'=>$student]);
        }
        else {  
            return view('student.close'); 
           /* $dep= Department::where(['faculty_id'=>$user->faculty_id,'is_active'=>1])->get();
        
        $cities= City::all();
        $specialities= Speciality::where(['department_id'=>$user->department_id,'is_active'=>1, 'is_deleted'=>0])->get(['id','title_fr','title']);
        
        
        return view('student.application_form')->with(['user'=>$user,'cities'=>$cities,'specialities'=>$specialities,'departments'=>$dep]);
        */ 
    }
        return back();
    }
    public function store(Request $request)
    {
        $code=$request->year_bac.$request->mat_bac;
        $request->request->add(['user_id' =>auth()->user()->id]);
        $request->request->add(['code' =>$code]);
        $request->request->add(['faculty_id' =>auth()->user()->faculty_id]);
        
        $request->request->add(['department_id' =>auth()->user()->department_id]);
        $nbchoix= auth()->user()->department->speciality_max_choice;
        
        $data = $request->all();
        $validator = Validator::make($data,
        [
            'user_id'=>['required','unique:students,user_id'],
            
            'nom_ar' => ['required', 'string', 'max:150'],
            'nom_fr' => ['required', 'string', 'max:150'],
            'prenom_ar' => ['required', 'string', 'max:150'],
            'prenom_fr' => ['required', 'string', 'max:150'],
            'date_nais' => ['required', 'string', 'max:10',
            new IsColumnsUnique('students', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']]),
        ],
            'phone' => ['string', 'max:14'],
            'code'=>['required', 'string', 'max:50','unique:students,code'],
            
            'file' => 'required|mimes:pdf|max:5172',
            'faculty_id'=> ['required','integer'],
            'department_id'=> ['required','integer'],
            
            'mat_bac' => ['required', 'string', 'max:20'],
            'year_bac' => ['required', 'integer'],
           // 'speciality_bac' => ['required', 'string', 'max:150'],
            'city_bac' => ['string', 'max:100'],
           // 'note_bac' => ['required','numeric', 'min:0', 'max:20'],
            'univ_origine'=>['required', 'string', 'max:50'],
            'licence'=>['required', 'string', 'max:100'],
            'licence_type'=>['required', 'string', 'max:10'],
            
            'S1'=>['required','numeric', 'min:0', 'max:20'],
            'S2'=>['required','numeric', 'min:0', 'max:20'],
            'S3'=>['required','numeric', 'min:0', 'max:20'],
            'S4'=>['required','numeric', 'min:0', 'max:20'],
            'S5'=>['numeric', 'min:0', 'max:20'], // must 'required' for LMD
            'S6'=>['numeric', 'min:0', 'max:20'],// must 'required' for LMD
            'annee_doublon'=>[ 'integer','min:0', 'max:4'],
            'nb_dette'=>[ 'integer','min:0', 'max:4'],
            'nb_rattrapage'=>[ 'integer','min:0', 'max:4'],

            'special_1' => ['required','integer' ],
            
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back()->withInput();
        }

        $fileName = time().'.'. $request->file->extension(); 
        $filePath = $request->file('file')->storeAs('uploads', $fileName);//storeAs('uploads', $fileName, 'public');
        $data['file_path']='/storage/app/' . $filePath;
        $data['password']= hash("sha256",$request->password);//?...........
        
        
        Student::create( $data );
        
        $etud= Student::where(['code'=> $code])->get(['id','code'])->first();
        
        
        for($i=1;$i<=$nbchoix; $i++){
        
            $speciality_student= array();
            if( $data['special_'.$i]!= null){
            $speciality_student= (['student_id'=> $etud->id,
                                'speciality_id'=> $data['special_'.$i],
                                'order'=>$i
                                ]);  
            SpecialityStudent::create($speciality_student);
            //flash('Speciality Student'. $i .'Successfully Added','success');
            }                     
        }
        
        flash('Speciality Student Successfully Added','success');
        
        return back();
    }
    public function studentHome()
    {
        $student= Student::where(['user_id'=>Auth::user()->id])->get()->first();
        if( $student)
        {
            return view('student.studentHome')->with(['student'=>$student]);
        }
    }
   

    public function print()
    {
        
        $user =  Auth::user();//User::find($id)->candidat;  ///Candidat::findOrFail($id);
        
        $student= Student::where(['user_id'=>Auth::user()->id])->get()->first();
        
        if( $student)
        {
            $specialities= SpecialityStudent::where(['student_id'=>$student->id])
            ->orderBy('order', 'asc')
            ->get(); 
        
            return view('student.print', compact('user','student','specialities'));
        }
    }
    public function show_uploaded_file()
    {  
        $student=Student::where(['user_id'=>Auth::user()->id])->get()->first();
        
        if( $student)
        {
                $file =base_path().$student->file_path; //app_path()
                
           if (file_exists($file)) {

                $headers = [
                    'Content-Type' => 'application/pdf'
                ];

                return response()->download($file, 'uploaded_file', $headers, 'inline');
            } else {
               // echo ('File not found!');
                abort(404, 'File not found!');
            }
        }
    }
    public function update_file(Student $student, Request $request)
    {
       
        $data = $request->all();
        $validator = Validator::make($data,
        [
            'file' => 'required|mimes:pdf|max:5172',
                    ]);
        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back()->withInput();
        }
       
        $fileName = time().'.'. $request->file->extension(); 
        $filePath = $request->file('file')->storeAs('uploads', $fileName);//storeAs('uploads', $fileName, 'public');
        $data['file_path']= '/storage/app/' . $filePath;
        $old_file=$student->file_path;
        $student->file_path = $data['file_path'];
       $r = $student->save();
       
       if($r){
        $old_file_path =base_path().$old_file;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);;
        }
       return  back()->with('success','file Has Been updated successfully');
      
    }
        else
        return   back()->with('error','error when file Has Been updated ');
        
    }

    public function edit(Student $student)
    {
        $dep= Department::where(['faculty_id'=>$student->faculty_id,'is_active'=>1])->get();
        
        $cities= City::all();
        $specialities= Speciality::where(['department_id'=>$student->department_id,'is_active'=>1, 'is_deleted'=>0])->get(['id','title_fr','title']);
        
        $SpecialityStudent= SpecialityStudent::where(['student_id'=>$student->id])
        ->orderBy('order', 'asc')
        ->get(); 
        return view('student.edit_application_form')->with(['student'=>$student,'cities'=>$cities,'SpecialityStudent'=>$SpecialityStudent,'specialities'=>$specialities,'departments'=>$dep]);
       

    }
    public function UpdateStudent(Student $student,Request $request)
    {
        $code=$request->year_bac.$request->mat_bac;
       $request->request->add(['code' =>$code]);
       
        $nbchoix= $student->department->speciality_max_choice;
        
        $data = $request->all();
        $validator = Validator::make($data,
        [
            'nom_ar' => ['required', 'string', 'max:150'],
            'nom_fr' => ['required', 'string', 'max:150'],
            'prenom_ar' => ['required', 'string', 'max:150'],
            'prenom_fr' => ['required', 'string', 'max:150'],
            'date_nais' => ['required', 'string', 'max:10',
            new IsColumnsUnique('students', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']],$student->id),
        ],
            'phone' => ['string', 'max:14'],
            'code'=>['required', 'string', 'max:50', Rule::unique('students', 'code')->ignore($student->id)],
            
            //'file' => 'required|mimes:pdf|max:5172',
            
            'mat_bac' => ['required', 'string', 'max:20'],
            'year_bac' => ['required', 'integer'],
           // 'speciality_bac' => ['required', 'string', 'max:150'],
            'city_bac' => ['string', 'max:100'],
           // 'note_bac' => ['required','numeric', 'min:0', 'max:20'],
            'univ_origine'=>['required', 'string', 'max:50'],
            'licence'=>['required', 'string', 'max:100'],
            'licence_type'=>['required', 'string', 'max:10'],
            
            'S1'=>['required','numeric', 'min:0', 'max:20'],
            'S2'=>['required','numeric', 'min:0', 'max:20'],
            'S3'=>['required','numeric', 'min:0', 'max:20'],
            'S4'=>['required','numeric', 'min:0', 'max:20'],
            'S5'=>['numeric', 'min:0', 'max:20'], // must 'required' for LMD
            'S6'=>['numeric', 'min:0', 'max:20'],// must 'required' for LMD
            'annee_doublon'=>[ 'integer','min:0', 'max:4'],
            'nb_dette'=>[ 'integer','min:0', 'max:4'],
            'nb_rattrapage'=>[ 'integer','min:0', 'max:4'],

            'special_1' => ['required','integer' ],
            
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back()->withInput();
        }
        /*
        $fileName = time().'.'. $request->file->extension(); 
        $filePath = $request->file('file')->storeAs('uploads', $fileName);//storeAs('uploads', $fileName, 'public');
        $data['file_path']='/storage/app/' . $filePath;
       */

        $r= $student->update($data  );
        if ($r)
        {
            flash('Data Successfully updated','success');
            //return redirect('student');
        }
        else
        {
            flash('Data no updated!!','error');
        }

        $SpecialityStudent = SpecialityStudent::where('student_id',$student->id)->get();
        foreach( $SpecialityStudent as $spec ){
            $spec->delete();

        }
        
        for($i=1;$i<=$nbchoix; $i++){
        
            $speciality_student= array();
            if( $data['special_'.$i]!= null){
            $speciality_student= (['student_id'=> $student->id,
                                'speciality_id'=> $data['special_'.$i],
                                'order'=>$i
                                ]);  
            SpecialityStudent::create($speciality_student);
            //flash('Speciality Student'. $i .'Successfully Added','success');
            }                     
        }
        
        flash('Speciality Student Successfully Added','success');
        
        return back();
    }

    public function deleteStudent(Student $student)
    {
        try
        {
            if($student)
            {
                $filename =base_path().$student->file_path;

                // Delete the file from the server
                if (file_exists($filename)) {
                    unlink($filename);;
                }                
                $student->delete();
            }
            return redirect()->route('students')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('students')->with('error', 'Error deleting user: ' . $e->getMessage());
        }

    }

    public function calculeClassementLMD() {

        $students= Student::where(['licence_type'=>'LMD'])
        ->where('S4','>',0)
        ->where('S5','>',0)
        ->where('S6','>',0)
        ->get();
        $i=0;
        foreach($students as $etu){
         $s1= $etu->S1;    $s2= $etu->S2;  $s3= $etu->S3;  $s4= $etu->S4;  $s5= $etu->S5;  $s6= $etu->S6; 
         $red= $etu->annee_doublon; $d= $etu->nb_dette; $s= $etu->nb_rattrapage;
        $s1 = floatval($s1);
        $s2 = floatval($s2);
        $s3 = floatval($s3);
        $s4 = floatval($s4);
        $s5 = floatval($s5);
        $s6 = floatval($s6);
        $red = intval($red);
        $d = intval($d);
        $s = intval($s);
        $moy = 0;
        $moys = 0;
        
        if (($s1 > 0 && $s2 > 0 && $s3 > 0 && $s4 > 0 && $s5 > 0 && $s6 > 0) &&
            ($s1 < 20 && $s2 < 20 && $s3 < 20 && $s4 < 20 && $s5 < 20 && $s6 < 20)) {
            $moys = (($s1 + $s2 + $s3 + $s4 + $s5 + $s6) / 6);
            $moy = ($moys * (1 - (0.04 * ($red + ($d / 2) + ($s / 4)))));
            $moy = number_format($moy, 2, '.', ''); // Format to two decimal places
           
            $etu->moy_classement= $moy;
           
            $etu->save();
            $i++;
        } else {
            return "Veuillez saisir toutes les données <br/>";
        }
    }
    return ($i.' : all is done');
    }

    public function calculeClassementClassique() {

        $students= Student::where(['licence_type'=>'Classique'])->get();
        $i=0;
        foreach($students as $etu){
         $s1= $etu->S1;    $s2= $etu->S2;  $s3= $etu->S3;  $s4= $etu->S4;
         $red= $etu->annee_doublon; $d= $etu->nb_dette; $s= $etu->nb_rattrapage;
       
        $s1 = floatval($s1);
        $s2 = floatval($s2);
        $s3 = floatval($s3);
        $s4 = floatval($s4);
        $red = intval($red);
        $s = intval($s);
        $moy = 0;
        $moys = 0;
    
        if (($s1 > 0 && $s2 > 0 && $s3 > 0 && $s4 > 0) && ($s1 < 20 && $s2 < 20 && $s3 < 20 && $s4 < 20)) {
            $moys = (($s1 + $s2 + $s3 + $s4) / 4);
            $moy = ($moys * (1 - (0.04 * ($red + ($s / 4)))));
            $moy = number_format($moy, 2, '.', ''); // Format to two decimal places
            $etu->moy_classement= $moy;
           
            $etu->save();
            $i++;
        } else {
            return "Veuillez saisir toutes les données <br/>";
        }
    }
    return ($i.' : all is done');
    }
    
    
    public function calculeClassementIngenieur() {

        $students= Student::where(['licence_type'=>'ingenieur'])->where('S5','>',0)->get();
        $i=0;
        foreach($students as $etu){
         $s1= $etu->S1;    $s2= $etu->S2;  $s3= $etu->S3;  $s4= $etu->S4; $s5= $etu->S5;
         $red= $etu->annee_doublon; $d= $etu->nb_dette; $s= $etu->nb_rattrapage;
       
        $s1 = floatval($s1);
        $s2 = floatval($s2);
        $s3 = floatval($s3);
        $s4 = floatval($s4);
        $s5 = floatval($s5);
        $red = intval($red);
        $s = intval($s);
        $moy = 0;
        $moys = 0;
    
        if (($s1 > 0 && $s2 > 0 && $s3 > 0 && $s4 > 0 && $s5>0) && ($s1 < 20 && $s2 < 20 && $s3 < 20 && $s4 < 20)) {
            $moys = (($s1 + $s2 + $s3 + $s4 +$s5) / 5);
            $moy = ($moys * (1 - (0.04 * ($red + ($s / 4)))));
            $moy = number_format($moy, 2, '.', ''); // Format to two decimal places
            $etu->moy_classement= $moy;
           
            $etu->save();
            $i++;
        } else {
            return "Veuillez saisir toutes les données <br/>";
        }
    }
    return ($i.' : all is done');
    }
    
}
