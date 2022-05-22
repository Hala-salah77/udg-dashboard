<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
class ApplicantsController extends Controller
{
        //Store Function
        function store(Request $request){

            $validated = $request->validate([
                'email' => 'required|email',
                'mobile' => 'required|max:18|min:10',
                'name' => 'required|string',
                'currentSalary'=> 'required|integer',
                'graduationYear'=> 'required|integer',
                'expectedSalary'=> 'required|integer',
                'birthDate'=> 'required|date',
                'cv'=> 'required|mimes:pdf,docx',
            ]);
            if($request->hasFile('cv')){
                $cv=$request->file('cv');
                $name=time().\Str::random(30).'.'.$cv->getClientOriginalExtension();
                $destinationPath=public_path('/imgs');
                $cv->move($destinationPath,$name);
                $fileName='imgs/'.$name;
            }
                $applicant=new Applicants();
                $applicant->email=$request->email;
                $applicant->mobile=$request->mobile;
                $applicant->stNumber=$request->stNumber;
                $applicant->name=$request->name;
                $applicant->currentSalary=$request->currentSalary;
                $applicant->graduationYear=$request->graduationYear;
                $applicant->expectedSalary=$request->expectedSalary;
                $applicant->birthDate=$request->birthDate;
                $applicant->cv=$fileName;
                $applicant->save();
                return response()->json($applicant);
            }
        public function listApplicants(){
            $contacts=Applicants::all();
            return $contacts;
        }

}
