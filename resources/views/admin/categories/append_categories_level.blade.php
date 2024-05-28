<div class="form-group">
    <label for="parent_id">Select Category Level</label>
    <select name="parent_id" id="parent_id" class="form-control" style="color: #000">
        <option value="0" @if (isset($category['parent_id']) && $category['parent_id']==0) selected @endif>Main Category</option>
        @if (!empty($getCategories))
        @foreach ($getCategories as $parentCategory)
        @php
        echo '
        <pre>', var_dump($getCategories), '</pre>';
        echo '
        <pre>', var_dump($parentCategory);
        echo '<pre>', var_dump($parentCategory['subCategories']);
            @endphp

                <option value="{{ $parentCategory['id'] }}"  @if (isset($category['parent_id']) && $category['parent_id'] == $parentCategory['id']) selected @endif >{{ $parentCategory['category_name'] }}</option>



                {{-- Show the Subcategories --}}
                @if (!empty($parentCategory['subCategories'])) {{-- Using the hasMany relationship in Category.php Model --}}
                    @foreach ($parentCategory['subCategories'] as $subcategory) {{-- Show the Subcategories --}}
                        <option value="{{ $subcategory['id'] }}"  @if (isset($subcategory['parent_id']) && $subcategory['parent_id'] == $subcategory['id']) selected @endif >&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option> {{-- https://www.w3schools.com/charsets/ref_html_entities_r.asp --}}
                    @endforeach
                @endif


            @endforeach


        @endif
    </select>
</div>