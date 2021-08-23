    <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>Category ID </th>
                            <th>Category title</th>
                            <th> SubCategory Id </th>
                            <th> SubCategory Title</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subCategories as $index=>$subCategory)
                        <tr>
                            <td> {{ $subCategory->category->id }}</td>
                            <td> {{ $subCategory->category->title }}</td>
                            <td> {{ $subCategory->id }}</td>
                            <td> {{ $subCategory->title }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- end of table -->
