<option value="" disabled selected>{{'Select Upazila'}}</option>
@forelse($upazilas as $upazila)
    <option value="{{$upazila->id}}">{{$upazila->name}}</option>
@empty
@endforelse
