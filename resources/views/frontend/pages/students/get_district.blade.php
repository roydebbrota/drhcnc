<option value="" disabled selected>{{'Select District'}}</option>
@forelse($districts as $district)
    <option value="{{$district->id}}">{{$district->name}}</option>
@empty
@endforelse
