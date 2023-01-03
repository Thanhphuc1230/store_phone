@include('website.partials.head')
@include('website.partials.header')

<div class="breadcrumbs_area mt-45">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{ route('website.index') }}">Trang chủ</a></li>
                        <li>sản phẩm sắp ra mắt</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product_page_bg">
    <div class="container">
        <div class="product_details_wrapper mb-55">
            <!--product details start-->
            <div class="product_details">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="product-details-tab">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src=" {{ asset('images/products/' . $product->images) }}"
                                        data-zoom-image=" {{ asset('images/products/' . $product->images) }}"
                                        alt="big-1">
                                </a>
                            </div>
                            <div class="single-zoom-thumb">
                                <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                    @foreach ($images_new3 as $images)
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update=""
                                                data-image=" {{ asset('files/' . $images) }}"
                                                data-zoom-image="{{ asset('files/' . $images) }}">
                                                <img src=" {{ asset('files/' . $images) }}" alt="zo-th-1" />
                                            </a>

                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="product_d_right">
                            <form action="#">

                                <h3><a href="#">{{ $product->name }}</a></h3>

                                {{-- <div class="product_rating">
                                    <ul>
                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                        <li class="review"><a href="#">(1 customer review )</a></li>
                                    </ul>
                                </div> --}}
                                <div class="price_box">
                                    <span class="old_price">{{ number_format($product->price, 0, '', '.') }}VND</span>
                                    <span class="current_price">{{ number_format($product->price, 0, '', '.') }}VND</span>
                                </div>
                                <div class="product_desc">
                                    <p>{{ $product->intro }} </p>
                                </div>
                                {{-- <div class="product_variant color">
                                    <h3>Available Options</h3>
                                    <label>color</label>
                                    <ul>
                                        <li class="color1"><a href="#"></a></li>
                                        <li class="color2"><a href="#"></a></li>
                                        <li class="color3"><a href="#"></a></li>
                                        <li class="color4"><a href="#"></a></li>
                                    </ul>
                                </div> --}}
                                <div class="product_timing">
                                    <div data-countdown="{{ $product->countdown }}">
                                        <div class="countdown_area">
                                            <div class="single_countdown">
                                                <div class="countdown_number">00</div>
                                                <div class="countdown_title">days</div>
                                            </div>
                                            <div class="single_countdown">
                                                <div class="countdown_number">00</div>
                                                <div class="countdown_title">hours</div>
                                            </div>
                                            <div class="single_countdown">
                                                <div class="countdown_number">00</div>
                                                <div class="countdown_title">mins</div>
                                            </div>
                                            <div class="single_countdown">
                                                <div class="countdown_number">00</div>
                                                <div class="countdown_title">secs</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_variant quantity">


                                    <button class="button" type="submit"> <a
                                            href="{{ route('website.addToWishList', ['id' => $product->id]) }}"
                                            title="Add to wishlist">+ Add to Wishlist</a></button>

                                </div>

                                {{-- <div class="product_meta">
                                    <span>Category: <a href="#">Clothing</a></span>
                                </div> --}}

                            </form>
                            {{-- <div class="priduct_social">
                                <ul>
                                    <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                                    <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                                    <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                                    <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                                    <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                                </ul>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
            <!--product details end-->

            <!--product info start-->
            <div class="product_d_info">
                <div class="row">
                    <div class="col-12">
                        <div class="product_d_inner">
                            <div class="product_info_button">
                                <ul class="nav" role="tablist" id="nav-tab">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#info" role="tab"
                                            aria-controls="info" aria-selected="false">Description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                            aria-selected="false">Specification</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                            aria-selected="false">Reviews (1)</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="product_info_content">
                                        <p>{{ $product->intro }}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="sheet" role="tabpanel">
                                    <div class="product_d_table">
                                        <form action="#">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="first_child">Compositions</td>
                                                        <td>Polyester</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="first_child">Styles</td>
                                                        <td>Girly</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="first_child">Properties</td>
                                                        <td>Short Dress</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="product_info_content">
                                        <p>Fashion has been creating well-designed collections since 2010. The brand
                                            offers feminine designs delivering stylish separates and statement dresses
                                            which have since evolved into a full ready-to-wear collection in which every
                                            item is a vital part of a woman's wardrobe. The result? Cool, easy, chic
                                            looks with youthful elegance and unmistakable signature style. All the
                                            beautiful pieces are made in Italy and manufactured with the greatest
                                            attention. Now Fashion extends to a range of accessories including shoes,
                                            hats, belts and more!</p>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="reviews_wrapper">
                                        <h2>1 review for Donec eu furniture</h2>
                                        @foreach ($comments as $comment)
                                            <div class="reviews_comment_box">
                                                <div class="comment_thmb">
                                                    <img src="{{ asset('images/users/' . $comment->avatar) }} "
                                                        alt="" style="width:50px">
                                                </div>
                                                <div class="comment_text">
                                                    <div class="reviews_meta">
                                                        {{-- <div class="product_rating">
                                                        <ul>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        </ul>
                                                    </div> --}}
                                                        <p><strong>{{ $comment->fullname }}</strong>
                                                            {{ $comment->created_at }}</p>
                                                        <span>{{ $comment->comments }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                        <div class="comment_title">
                                            <h2>Add a review </h2>
                                        </div>
                                        {{-- <div class="product_rating mb-10">
                                            <h3>Your rating</h3>
                                            <ul>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="product_review_form">
                                            <form
                                                action="{{ route('website.postComment', ['uuid' => $product->uuid]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="review_comment">Your review </label>
                                                        <textarea name="comments" id="review_comment"></textarea>
                                                    </div>

                                                </div>
                                                @if (Auth::user())
                                                    <button type="submit">Post Comment</button>
                                                @endif
                                                @if (!Auth::user())
                                                    <div class="cart_button">
                                                        <a href="{{ route('website.check') }}">Post Comment</a>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--product info end-->
        </div>

        <!--product area start-->
        <section class="product_area related_products">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản phẩm tương tự </h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_style product_column5 owl-carousel">
                @foreach ($product_related as $item)
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img"
                                    href="{{ route('website.detail', ['id' => $item->name]) }}"><img
                                        src="{{ asset('images/products/' . $item->images) }}" alt=""></a>
                                <a class="secondary_img"
                                    href="{{ route('website.detail', ['id' => $item->name]) }}"><img
                                        src="{{ asset('images/products/' . $item->images) }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="wishlist"><a
                                                href="{{ route('website.addToWishList', ['id' => $item->id]) }}"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-tippy="Add to Wishlist"><i
                                                    class="fa-regular fa-heart"></i></a></li>
                                        {{-- <li class="compare"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-tippy="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li>
                                    <li class="quick_button"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-bs-toggle="modal" data-bs-target="#modal_box" data-tippy="quick view"><i class="ion-ios-search-strong"></i></a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a
                                            href="{{ route('website.detail', ['id' => $item->name]) }}">{{ $item->name }}</a>
                                    </h4>
                                    <div class="price_box">
                                        <span class="old_price">{{ number_format($item->price, 0, '', '.') }}VND</span>
                                        <span
                                            class="current_price">{{ number_format($item->price, 0, '', '.') }}VND</span>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="{{ route('website.addToCart', ['id' => $item->id]) }}"
                                        title="Add to cart">Thêm vào giỏ hàng</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                @endforeach

            </div>

        </section>
        <!--product area end-->
    </div>
</div>
@include('website.partials.footer')
