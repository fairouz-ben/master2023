<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class IsColumnsUnique implements ValidationRule
{
    private string $tableName;
    private array $compositeColsKeyValue = [];
    private $rowId;

    public function __construct(string $tableName, array $compositeColsKeyValue, $rowId = null)
    {
        $this->tableName = $tableName;
        $this->compositeColsKeyValue = $compositeColsKeyValue;
        $this->rowId = $rowId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $passess = true;
 
        if ($this->rowId) {
            $record = DB::table($this->tableName)->where($this->compositeColsKeyValue)->first();
            $passess = !$record || ($record && $record->id == $this->rowId);
        } else {
            $passess = !DB::table($this->tableName)->where($this->compositeColsKeyValue)->exists();
        }
  
        if (!$passess) {
          // $fail($this->duplicatesErrorMessage());
           $fail('اللقب والاسم الأول والتاريخ موجودان بالفعل!');
        }
    }
    private function duplicatesErrorMessage()
   {
       $colNames = '';
       foreach ($this->compositeColsKeyValue as $col => $value) {
           $colNames .= $col . ', ';
       }
       $colNames = rtrim($colNames, ', ');
 
       return "The combination of ".$colNames." must be unique.";
   }
}
