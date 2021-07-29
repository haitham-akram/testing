<?php

namespace App\Http\Controllers\Relations;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class RelationsController extends Controller
{
    public function hasOneRelation(){
     //   $phone = Phone::with('user')->find('1');
       // $phone->user;
        $user=User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])->find('6');
        $user->phone->code;
        //dd($user->phone->code);
        dd($user->ToArray());
       // return response()->json($user);
    }
    public function hasOneReversRelation(){
        $phone = Phone::with(['user'=>function($q){
            $q->select('id','name');
        }])->find('1');
     //make some attribute visible
        $phone->makeVisible(['user_id']);
       // $phone->makeHidden(['code']);
       // $phone->user;
        dd($phone->ToArray());
    }
    public function getUserHasPhone(){
        //$user = User::whereHas('phone')->get();
        //with condition
        $value = '970';
        $user = User::whereHas('phone')->get();
        dd($user->ToArray());
    }
    public function getUserDoesNotHavePhone(){
        $user = User::whereDoesntHave('phone')->get();
        dd($user->ToArray());
    }
    public function getUserHasPhoneWithCondition(){
        $value = '970';
        $user = User::whereHas('phone',function($q) use($value){
            $q->where('code',$value);
        })->get();
        dd($user->ToArray());
    }
    ####### one to many relationships methods
    public function getHopitals(){
   //$hospital= Hospital::with('Doctors')->find('1');
   $hospital= Hospital::with('Doctors')->get();
   return view('doctor.hospitals')->with('hospitals',$hospital);
        // $doctors= $hospital->Doctors;
//      foreach ($doctors as $doctor){
//      echo  $doctor->name.'<br>';
//      }
//    $Doctor= Doctor::find(3);//with('hospital')->
//      $hospital_name=  $Doctor->Hospital->name;
//      dd($hospital_name);
    }
    public function getDoctors($hopital_id){
        $hospital= Hospital::with('Doctors')->find($hopital_id);
        $hospital_name=$hospital->name;
         $doctors= $hospital->Doctors;
        return view('doctor.doctors')->with('doctors',$doctors)->with('hospital_name',$hospital_name);
    }
    //get all hospital which must has doctors
    public function hospitalsHasDoctors(){
     $hospitals =Hospital::whereHas('Doctors')->get();
    dd($hospitals->ToArray());
    }
    public function hospitalsHasMaleDoctors(){
        $hospitals =Hospital::with('Doctors')->whereHas('Doctors',function ($q){
            $q->where('gender',1);
        })->get();
        dd($hospitals->ToArray());
    }
    public function hospitalsDontHaveDoctors(){
        $hospitals =Hospital::whereDoesntHave('Doctors')->get();
        dd($hospitals->ToArray());
    }
    public function deleteHospital($hospital_id){
    $hospital= Hospital::find($hospital_id);
    if(!$hospital){
      //  return abort('404');
       return redirect()->back()->with(['error'=>__('messages.error')]);
    }
        $hospital->Doctors()->delete();//delete the child(doctors) first
        $hospital->delete();//delete the parent

        return redirect()
            ->back()
            ->with(['success'=>__('messages.success')]);

    }
    #######end one to many relationships
    #######start many to many relationship
    public function getDoctorServices(){
        $services = Doctor::with('Services')->find(1);
        dd($services->ToArray());
    }
    public function getServiceDoctors(){
        $doctor = Service::with('Doctors')->find(1);
        dd($doctor->ToArray());
    }
    public function getDoctorServicesByID($id){
        $doctor = Doctor::find($id);
       $services= $doctor->services;
       $doctors = Doctor::get();
       $all_services=Service::get();
        return view('doctor.services')
            ->with('services',$services)
            ->with('doctor',$doctor)
            ->with('doctors',$doctors)
            ->with('all_services',$all_services);
    }
    public function SaveServicesToDoctor(Request $request){
       $doctor  =Doctor::find($request->doctor_id);
       if(!$doctor)
           return abort('404');
    //   $doctor->Services()->attach($request->Service_id);
      // $doctor->Services()->sync($request->Service_id);
        $doctor->Services()->syncWithoutDetaching($request->Service_id);
       return redirect()->back();
    }

    #######end many to many


}
