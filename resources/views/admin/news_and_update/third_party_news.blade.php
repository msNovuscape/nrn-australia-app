@if(isset($setting))
    <div class="col-md-12 my_section">
        <div class="form-group">
            <label>URL <span style="color: red";> * </span></label>
            <input type="text" class="form-control"  name="url" value="{{$setting->third_party_news->url}}" required>
        </div>
    </div>
@else
    <div class="col-md-12 my_section">
        <div class="form-group">
            <label>URL <span style="color: red";> * </span></label>
            <input type="text" class="form-control"  name="url" value="{{old('url')}}" required>
        </div>
    </div>
@endif

