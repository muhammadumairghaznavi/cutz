  <table class="table table-hover" id="data_table">
      <thead>
          <tr>
              <th>section-id  </th>
              <th>section title </th>
              <th>category id </th>
              <th>category title </th>

              {{-- <th>@lang('site.description')</th> --}}
          </tr>
      </thead>
      <tbody>
          @foreach ($categories as $index=>$category)
          <tr>

              <td> {{ $category->section->id??"" }}</td>
              <td> {{ $category->section->title??"" }}</td>
              <td> {{ $category->id }}</td>
              <td> {{ $category->title }}</td>
              {{-- <td> {{ $category->description }}</td> --}}
          </tr>
          @endforeach
      </tbody>
  </table><!-- end of table -->
