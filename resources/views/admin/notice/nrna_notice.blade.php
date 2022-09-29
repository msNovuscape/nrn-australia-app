@if(isset($setting))
    <div class="col-md-12 my_section" >
        <div class="form-group" >
            <label>Description <span style="color: red";> * </span></label>
            <textarea name="description" id="body1" rows="5" required style="height: 658px;" >{!! $setting->nrn_notice->description !!}</textarea>
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label> Image Caption </label>
            <input type="text" class="form-control"  name="image_caption" value="{{$setting->nrn_notice->image_caption}}">
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label> Image Credit </label>
            <input type="text" class="form-control"   name="image_credit" value="{{$setting->nrn_notice->image_credit}}">
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label>Image alt</label>
            <input type="text" class="form-control"   name="image_alt" value="{{$setting->nrn_notice->image_alt}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Seo Title</label>
            <input type="text" class="form-control"   name="seo_title" value="{{$setting->nrn_notice->seo_title}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label> Keyword</label>
            <input type="text" class="form-control"   name="keyword" value="{{$setting->nrn_notice->keyword}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Seo Description </label>
            <textarea id="body2" name="seo_description">{!! $setting->nrn_notice->seo_description !!}</textarea>
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Meta Keyword</label>
            <textarea id="body3" name="meta_keyword" >{!! $setting->nrn_notice->meta_keyword !!}</textarea>
        </div>
    </div>
@else
    <div class="col-md-12 my_section" >
        <div class="form-group" >
            <label>Description <span style="color: red";> * </span></label>
            <textarea name="description" id="body1" rows="5" required style="height: 658px;" >{{old('description')}}</textarea>
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label> Image Caption </label>
            <input type="text" class="form-control"  id="inputPassword3" name="image_caption" value="{{old('image_caption')}}">
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label> Image Credit </label>
            <input type="text" class="form-control"  id="inputPassword3" name="image_credit" value="{{old('image_credit')}}">
        </div>
    </div>
    <div class="col-md-4 my_section" >
        <div class="form-group">
            <label>Image alt</label>
            <input type="text" class="form-control"  id="inputPassword3" name="image_alt" value="{{old('image_alt')}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Seo Title</label>
            <input type="text" class="form-control"  id="inputPassword3" name="seo_title" value="{{old('seo_title')}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label> Keyword</label>
            <input type="text" class="form-control"  id="inputPassword3" name="keyword" value="{{old('keyword')}}">
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Seo Description </label>
            <textarea id="body2" name="seo_description">{{old('seo_description')}}</textarea>
        </div>
    </div>
    <div class="col-md-6 my_section" >
        <div class="form-group">
            <label>Meta Keyword</label>
            <textarea id="body3" name="meta_keyword" >{{old('meta_keyword')}}</textarea>
        </div>
    </div>
@endif

