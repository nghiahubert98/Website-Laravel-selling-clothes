<div id="categorymenu">
    <nav class="subnav">
        <ul class="nav-pills categorymenu">
            <li><a class="active"  href="{{ url('/index')}}">TRANG CHỦ</a></li>
            <?php
                $menu_level_1 = DB::table('categories')->where('parent_id',0)->get();
            ?>
            @foreach($menu_level_1 as $item_level_1)
            <?php
                $cate_count = DB::table('categories')
                            ->where('categories.parent_id',$item_level_1->id)->count();
            ?>
            <li><a  href="{!! URL( ($cate_count != 0) ? 'product-cate-grandparent' :'product-cate',[$item_level_1->id,$item_level_1->alias]) !!}">{!! $item_level_1->name !!}</a>
                <div>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <?php
                            $menu_level_2 = DB::table('categories')->where('parent_id',$item_level_1->id)->get();
                         ?>
                        @if(isset($menu_level_2))
                            @foreach($menu_level_2 as $item_level_2)
                            <li class="dropdown-submenu"><a tabindex="-1" href="{!! URL('product-cate-parent',[$item_level_2->id,$item_level_2->alias]) !!}">{!! $item_level_2->name !!}</a>
                                        <ul class="dropdown-menu">
                                            <?php
                                                $menu_level_3 = DB::table('categories')->where('parent_id',$item_level_2->id)->get();
                                             ?>
                                            @if(isset($menu_level_2))
                                                @foreach($menu_level_3 as $item_level_3)
                                                <li class="dropdown-item"><a href="{!! URL('product-cate',[$item_level_3->id,$item_level_3->alias]) !!}">{!! $item_level_3->name !!}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </li>
            @endforeach
            <div style="width: 300px" class="pull-right">
            <input type="text" class="js-range-slider" name="my_range" value="" />
            <script type="text/javascript">
                var my_range = $(".js-range-slider");
                var minPrice = $("input[name='min_price']").val();  
                var maxPrice = $("input[name='max_price']").val(); 

                my_range.ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 1000000,
                    from: minPrice,
                    to: maxPrice,
                    grid: true,
                    step: 10,
                    prefix: "đ"
                });  
                my_range.on("change", function () {
                    var $this = $(this), value = $this.prop("value").split(";");
                    var minPrice = value[0];
                    var maxPrice = value[1];
                   $("input[name='min_price']").val(minPrice);
                   $("input[name='max_price']").val(maxPrice);
                }); 
            </script>
            </div>
        </ul>
    </nav>
</div>
