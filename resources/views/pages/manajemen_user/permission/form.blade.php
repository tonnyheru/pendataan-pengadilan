<div class="row">
  <input type="hidden" name="uid" value="{{ @$uid }}">
    <div class="form-group col-md-12">
      <label>Slug <span class="text-danger">*</span></label>
      <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ @$data->slug }}">
    </div>
    <div class="form-group col-md-12">
      <label>Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" placeholder="Name" value="{{ @$data->name }}">
    </div>
    <div class="form-group col-md-12">
      <label>Description</label>
      <textarea name="description" placeholder="Description" class="form-control">{{ @$data->description }}</textarea>
    </div>
</div>
  