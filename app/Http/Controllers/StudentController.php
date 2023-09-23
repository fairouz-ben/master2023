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
            $dep= Department::where(['faculty_id'=>$user->faculty_id,'is_active'=>1])->get();
        
        $cities= City::all();
        $specialities= Speciality::where(['department_id'=>$user->department_id,'is_active'=>1, 'is_deleted'=>0])->get(['id','title_fr','title']);
        
        
        return view('student.application_form')->with(['user'=>$user,'cities'=>$cities,'specialities'=>$specialities,'departments'=>$dep]);
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
        $data['password']= hash("sha256",$request->password);
        
        
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
        $data['file_path']='/storage/app/' . $filePath;
        $old_file=$student->file_path;
        $student->file_path=$data['file_path'];
        $student->save();
        $old_file_path =base_path().$old_file;

        // Delete the file from the server
        if (file_exists($old_file_path)) {
            unlink($old_file_path);;
        }
        return   back()->with('success','file Has Been updated successfully');
        
       
    }
    public function edit()
    {
        return ('Here where editing student data!!!!!');
    }
    
}
