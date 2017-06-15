<section class="filter" id ="secondaryNav">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-4 hidden-xs">
                <div class="filter-set1">
                    <div class="category-filter">
                        {!! Form::select('categoryFilter', ['all' => 'All Categories'] + $navCategories->pluck('name', 'name')->toArray(), request('category', 'all'), ['id' => 'categoryFilter']) !!}
                    </div>

                    <div class="tag-filter">
                        {!! Form::select('tagFilter', $productTags->pluck('name', 'name'), request('tags', $productTags->pluck('name', 'name')->toArray()), ['id' => 'tagFilter', 'multiple' => 'multiple']) !!}
                    </div>

                    {{--<div class="search-filter">--}}
                        {{--{!! Form::open(['route' => 'search', 'class' => 'form-inline', 'method' => 'get', 'id' => 'search']) !!}--}}
                        {{--<div class="form-group">--}}
                            {{--<div class=" input-group" style="display: inline-flex;">--}}
                                {{--<span class=" btn" type="submit"><i class="fa fa-search fa-fw"></i></span>--}}
                                {{--{!! Form::text('q', request('q', null), ['class' => 'form-control navbar-search', 'placeholder' => 'eg: Restaurant...']) !!}--}}
                                {{--<button type="submit" class="input-group-addon"><i class="fa fa-search fa-fw"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                </div>
            </div>

            {{--<div class="col-md-5 col-xs-12">
                <div class="filter-set2">
                    <div class="price-filter">
                        {!! Form::select('priceSort', ['all' => 'All', 'premium' => 'Premium', 'free' => 'Free'], request('price', 'all'), ['id' => 'priceSort']) !!}
                    </div>

                    <div class="sort">
                        {!! Form::select('choiceSort', ['best_sseller' => 'Best Seller', 'latest' => 'Latest', 'popular' => 'Popular'], request('choice', 'popular'), ['id' => 'choiceSort']) !!}
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</section>

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            var $categoryFilter = $('#categoryFilter');
            var $tagsFilter = $('#tagFilter');
            var $searchForm = $('#search');
            var $priceFilter = $('#priceSort');
            var $choiceFilter = $('#choiceSort');
            var $filteredThemes = $('#filtered-themes');
            var $loader = $('#loader');

            function getThemes(pageNo) {
                var category = $categoryFilter.val();
                var tags = $tagsFilter.val();
                var search = $searchForm.find('input').val();
                var price = $priceFilter.val();
                var choice = $choiceFilter.val();

                $loader.slideDown();

                var ajaxParams = {
                    'category':  category,
                    'search':  search,
                    'price':  price,
                    'choice':  choice,
                    'tags':  tags
                };

                if(pageNo) ajaxParams.page = pageNo;

                $.ajax({
                    cache: false,
                    url : '{{ route('product') }}',
                    method : 'GET',
                    data : ajaxParams,
                    success : function(result,status,xhr){
                        var pageurl = this.url;
                        if(pageurl != window.location) {
                            window.history.pushState({path:pageurl},'',pageurl);
                        }
                        $filteredThemes.html(result.view);

                        $loader.slideUp();
                    },
                    error : function(xhr,status,error){
                        var pageurl = this.url;
                        if(pageurl != window.location) {
                            window.history.pushState({path:pageurl},'',pageurl);
                        }
                        $loader.slideUp();
                    }
                });
            }


            getThemes();

            $categoryFilter.multiselect({
                onChange: function(element, checked) {
                    getThemes();
                }
            });
            $tagsFilter.multiselect({
                includeSelectAllOption: true,
                allSelectedText: 'All Tags',
                selectAllText: 'All Tags',
                nonSelectedText: 'No Tags Selected',
                onDropdownHide: function(element, checked) {
                    getThemes();
                }
            });
            $searchForm.submit(function (e) {
                e.preventDefault();
                getThemes();
            });
            $priceFilter.multiselect({
                onChange: function(element, checked) {
                    getThemes();
                }
            });
            $choiceFilter.multiselect({
                onChange: function(element, checked) {
                    getThemes();
                }
            });

            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                        results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }

            $filteredThemes.on('click', '#ajax-pagination a', function (e) {
                e.preventDefault();
                var pageNo = getParameterByName('page', e.target.href);
                getThemes(pageNo);
            })


        });
    </script>
@endsection