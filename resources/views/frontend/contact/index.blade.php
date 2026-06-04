@extends('layouts.frontend.app')
@section('meta_description', 'Liên hệ Hoa Gỗ Mộc Hương tại Long Xuyên để đặt hoa tươi, hoa cưới, hoa sinh nhật và quà tặng. Hỗ trợ nhanh qua điện thoại, Zalo, Facebook và Instagram.')
@section('meta_keywords', 'liên hệ shop hoa, Hoa Gỗ Mộc Hương, địa chỉ shop hoa Long Xuyên, số điện thoại đặt hoa')
@section('canonical', route('frontend.contact.index'))
@section('og_image', asset('assets/img/logo/logo.jpeg'))

@section('title', 'Liên hệ - Mộc Hương Flower')

@section('content')
    <style>
        .contact-page {
            background: var(--cream);
        }

        /* ─── HERO ─── */
        .contact-hero {
            background: linear-gradient(135deg, #1a6b6e 0%, #2BAAAD 60%, #3dc4c8 100%);
            padding: 64px 0 48px;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .contact-hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .contact-hero-logo {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, .35);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .2);
            flex-shrink: 0;
        }

        .contact-hero-text h1 {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: clamp(1.6rem, 3.5vw, 2.2rem);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .contact-hero-text h1 em {
            color: #8dd5d7;
            font-style: italic;
        }

        .contact-hero-text p {
            color: #b2e8ea;
            font-size: 0.9rem;
            margin: 0;
        }

        .contact-hero-divider {
            width: 1px;
            height: 60px;
            background: rgba(255, 255, 255, .25);
            flex-shrink: 0;
        }

        .contact-hero-stats {
            display: flex;
            gap: 32px;
        }

        .contact-hero-stat strong {
            display: block;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        .contact-hero-stat span {
            font-size: 0.75rem;
            color: #7ec8ca;
            margin-top: 4px;
            display: block;
        }

        @media(max-width:767px) {

            .contact-hero-stats,
            .contact-hero-divider {
                display: none;
            }

            .contact-hero-inner {
                gap: 16px;
            }

            .contact-hero-logo {
                width: 72px;
                height: 72px;
            }
        }

        /* ─── ABOUT SECTION ─── */
        .about-section {
            background: #fff;
            padding: 56px 0;
            border-bottom: 1.5px solid #e8f5f5;
        }

        .about-section .section-label {
            color: var(--green-main);
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .about-section .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.4rem, 3vw, 2rem);
            color: var(--text-dark);
            font-weight: 700;
            margin: 8px 0 0;
        }

        .about-desc {
            font-size: .9rem;
            color: var(--text-muted);
            line-height: 1.85;
            margin-top: 16px;
        }

        .about-feature {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px;
            border-radius: 14px;
            border: 1.5px solid #e8f5f5;
            background: #fff;
            transition: all .25s;
            height: 100%;
        }

        .about-feature:hover {
            border-color: var(--green-main);
            box-shadow: 0 6px 20px rgba(43, 170, 173, .1);
            transform: translateY(-3px);
        }

        .about-feature-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: var(--green-main);
            flex-shrink: 0;
        }

        .about-feature-title {
            font-weight: 700;
            font-size: .88rem;
            color: var(--text-dark);
            margin-bottom: 3px;
        }

        .about-feature-desc {
            font-size: .78rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ─── CONTACT SECTION ─── */
        .contact-section {
            padding: 56px 0;
        }

        /* ─── INFO CARD ─── */
        .cinfo-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e8f5f5;
            overflow: hidden;
            height: 100%;
        }

        .cinfo-card-header {
            background: var(--green-dark);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cinfo-card-header i {
            color: #b2e8ea;
            font-size: 1rem;
        }

        .cinfo-card-header span {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
        }

        .cinfo-card-body {
            padding: 20px 24px;
        }

        .cinfo-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f9f9;
        }

        .cinfo-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .cinfo-row:first-child {
            padding-top: 0;
        }

        .cinfo-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: var(--green-main);
            flex-shrink: 0;
        }

        .cinfo-label {
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .cinfo-value {
            font-size: .85rem;
            color: var(--text-dark);
            line-height: 1.5;
        }

        .cinfo-value a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .cinfo-value a:hover {
            color: var(--green-main);
        }

        /* Social buttons */
        .social-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .social-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1.5px solid #e8f5f5;
            text-decoration: none;
            color: var(--text-dark);
            font-size: .84rem;
            font-weight: 500;
            transition: all .2s;
        }

        .social-item:hover {
            transform: translateX(4px);
        }

        .social-item-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .social-item small {
            font-size: .72rem;
            color: var(--text-muted);
            display: block;
            font-weight: 400;
        }

        .si-phone .social-item-icon {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .si-phone:hover {
            border-color: #a5d6a7;
            background: #f1f8f1;
        }

        .si-zalo .social-item-icon {
            background: #e3f2fd;
            color: #1565c0;
        }

        .si-zalo:hover {
            border-color: #90caf9;
            background: #f0f7ff;
        }

        .si-fb .social-item-icon {
            background: #e8eaf6;
            color: #1565c0;
        }

        .si-fb:hover {
            border-color: #9fa8da;
            background: #f3f4fb;
        }

        .si-ig .social-item-icon {
            background: #fce4ec;
            color: #ad1457;
        }

        .si-ig:hover {
            border-color: #f48fb1;
            background: #fdf3f6;
        }

        .si-tt .social-item-icon {
            background: #f3e5f5;
            color: #4a148c;
        }

        .si-tt:hover {
            border-color: #ce93d8;
            background: #faf3fc;
        }

        /* Hours */
        .hours-row {
            display: flex;
            justify-content: space-between;
            font-size: .82rem;
            padding: 7px 0;
            border-bottom: 1px solid #f0f9f9;
            color: var(--text-muted);
        }

        .hours-row:last-child {
            border-bottom: none;
        }

        .hours-row strong {
            color: var(--text-dark);
            font-size: .82rem;
        }

        .hours-open {
            color: var(--green-main);
            font-weight: 600;
        }

        /* Map */
        .contact-map {
            border-radius: 20px;
            overflow: hidden;
            border: 1.5px solid #e8f5f5;
            height: 240px;
            margin-top: 20px;
        }

        .contact-map iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        /* ─── FEEDBACK SECTION ─── */
        .feedback-section {
            background: #fff;
            padding: 56px 0;
            border-top: 1.5px solid #e8f5f5;
        }

        .feedback-track-wrap {
            position: relative;
            overflow: hidden;
            margin: 0 -8px;
        }

        .feedback-track {
            display: flex;
            gap: 20px;
            padding: 8px 8px 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            cursor: grab;
        }

        .feedback-track:active {
            cursor: grabbing;
        }

        .feedback-track::-webkit-scrollbar {
            display: none;
        }

        .feedback-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8f5f5;
            padding: 22px 20px;
            min-width: 300px;
            max-width: 300px;
            scroll-snap-align: start;
            flex-shrink: 0;
            transition: box-shadow .25s, transform .25s;
            position: relative;
        }

        .feedback-card:hover {
            box-shadow: 0 10px 32px rgba(43, 170, 173, .12);
            transform: translateY(-3px);
        }

        .feedback-card::before {
            content: '\201C';
            font-family: 'Playfair Display', serif;
            font-size: 5rem;
            color: var(--green-pale);
            position: absolute;
            top: -8px;
            left: 16px;
            line-height: 1;
            pointer-events: none;
        }

        /* feedback ảnh */
        .feedback-card.is-image {
            padding: 0;
            overflow: hidden;
        }

        .feedback-card.is-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .feedback-card.is-image .fb-img-caption {
            padding: 12px 16px;
            font-size: .78rem;
            color: var(--text-muted);
        }

        .feedback-card.is-image::before {
            display: none;
        }

        .fb-stars {
            color: var(--gold);
            font-size: .85rem;
            margin-bottom: 10px;
        }

        .fb-text {
            font-size: .85rem;
            color: var(--text-muted);
            line-height: 1.7;
            font-style: italic;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .fb-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fb-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            color: var(--green-main);
            font-weight: 700;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }

        .fb-name {
            font-weight: 700;
            font-size: .84rem;
            color: var(--text-dark);
        }

        .fb-date {
            font-size: .72rem;
            color: var(--text-muted);
        }

        /* Nav arrows */
        .feedback-nav {
            display: flex;
            gap: 8px;
        }

        .feedback-nav-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid #b2e8ea;
            background: #fff;
            color: var(--green-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .9rem;
            transition: all .2s;
        }

        .feedback-nav-btn:hover {
            background: var(--green-main);
            border-color: var(--green-main);
            color: #fff;
        }

        /* fade edges */
        .feedback-track-wrap::before,
        .feedback-track-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 20px;
            width: 40px;
            z-index: 2;
            pointer-events: none;
        }

        .feedback-track-wrap::before {
            left: 0;
            background: linear-gradient(to right, #fff, transparent);
        }

        .feedback-track-wrap::after {
            right: 0;
            background: linear-gradient(to left, #fff, transparent);
        }
    </style>

    <div class="contact-page">

        {{-- ── HERO ── --}}
        <div class="contact-hero">
            <div class="container">
                <div class="contact-hero-inner">
                    <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Mộc Hương" class="contact-hero-logo">
                    <div class="contact-hero-text">
                        <h1>Mộc Hương</h1>
                        <p>Shop hoa tươi uy tín — Long Xuyên, An Giang</p>
                    </div>
                    <div class="contact-hero-divider"></div>
                    <div class="contact-hero-stats">
                        <div class="contact-hero-stat"><strong>500+</strong><span>Mẫu hoa</span></div>
                        <div class="contact-hero-stat"><strong>10K+</strong><span>Khách hàng</span></div>
                        <div class="contact-hero-stat"><strong>8 năm</strong><span>Kinh nghiệm</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── GIỚI THIỆU ── --}}
        <section class="about-section">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="section-label">Câu chuyện của chúng tôi</div>
                        <h2 class="section-title">Hơn 8 năm <br>ươm trồng yêu thương</h2>
                        <div class="divider-leaf"></div>
                        <p class="about-desc">
                            Mộc Hương Flower ra đời từ tình yêu thuần túy với hoa tươi. Từ một tiệm hoa nhỏ tại Long Xuyên,
                            chúng tôi đã phục vụ hàng chục nghìn khách hàng với phương châm <strong>hoa đẹp – giao nhanh –
                                giá hợp lý</strong>.
                        </p>
                        <p class="about-desc" style="margin-top:0;">
                            Mỗi bó hoa là một thông điệp yêu thương được chúng tôi gửi gắm tỉ mỉ từ khâu chọn hoa, thiết kế
                            đến tận tay người nhận trong vòng 2 giờ.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="row g-3">
                            @php
                                $features = [
                                    ['fas fa-leaf', 'Hoa tươi mỗi ngày', 'Nhập hoa trực tiếp từ Đà Lạt và các vựa hoa uy tín, đảm bảo tươi 100%.'],
                                    ['fas fa-truck', 'Giao hàng trong 2 giờ', 'Giao hàng nhanh nội thành Long Xuyên, đúng giờ đúng hẹn.'],
                                    ['fas fa-palette', 'Thiết kế theo yêu cầu', 'Tùy chỉnh màu sắc, kiểu dáng, lời nhắn theo ý muốn của bạn.'],
                                    ['fas fa-shield-alt', 'Cam kết chất lượng', 'Hoàn tiền hoặc đổi hoa nếu sản phẩm không đúng như mô tả.'],
                                    ['fas fa-clock', 'Phục vụ 7 ngày/tuần', 'Mở cửa từ 7:00 đến 21:00 tất cả các ngày trong tuần.'],
                                    ['fas fa-star', 'Hơn 3.200 đánh giá 5★', 'Khách hàng hài lòng là động lực lớn nhất của chúng tôi.'],
                                ];
                            @endphp
                            @foreach($features as $f)
                                <div class="col-sm-6">
                                    <div class="about-feature">
                                        <div class="about-feature-icon"><i class="{{ $f[0] }}"></i></div>
                                        <div>
                                            <div class="about-feature-title">{{ $f[1] }}</div>
                                            <div class="about-feature-desc">{{ $f[2] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── LIÊN HỆ ── --}}
        <section class="contact-section">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-label">Kết nối với chúng tôi</div>
                    <h2 class="section-title">Thông tin liên hệ</h2>
                    <div class="divider-leaf mx-auto" style="margin-top:10px;"></div>
                </div>

                <div class="row g-4">

                    {{-- Thông tin --}}
                    <div class="col-lg-4">
                        <div class="cinfo-card">
                            <div class="cinfo-card-header">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Địa chỉ & Giờ mở cửa</span>
                            </div>
                            <div class="cinfo-card-body">
                                <div class="cinfo-row">
                                    <div class="cinfo-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div>
                                        <div class="cinfo-label">Địa chỉ</div>
                                        <div class="cinfo-value">Số 223, đường cặp rạch Gòi Lớn, khóm Mỹ Phú, phường Long
                                            Xuyên, tỉnh An Giang</div>
                                    </div>
                                </div>
                                <div class="cinfo-row">
                                    <div class="cinfo-icon"><i class="fas fa-phone-alt"></i></div>
                                    <div>
                                        <div class="cinfo-label">Điện thoại</div>
                                        <div class="cinfo-value"><a href="tel:0888796364">0888 796 364</a></div>
                                    </div>
                                </div>
                                <div class="cinfo-row">
                                    <div class="cinfo-icon"><i class="fas fa-envelope"></i></div>
                                    <div>
                                        <div class="cinfo-label">Email</div>
                                        <div class="cinfo-value"><a href="mailto:
    store.mochuong@gmail.com">
                                                store.mochuong@gmail.com</a></div>
                                    </div>
                                </div>
                                <div style="margin-top:16px;padding-top:16px;border-top:1px solid #f0f9f9;">
                                    <div class="cinfo-label" style="margin-bottom:10px;">Giờ mở cửa</div>
                                    <div class="hours-row"><strong>Thứ 2 – Thứ 7</strong><span class="hours-open">7:00 –
                                            21:00</span></div>
                                    <div class="hours-row"><strong>Chủ nhật</strong><span class="hours-open">8:00 –
                                            20:00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mạng xã hội --}}
                    <div class="col-lg-4">
                        <div class="cinfo-card">
                            <div class="cinfo-card-header">
                                <i class="fas fa-share-alt"></i>
                                <span>Kênh liên hệ</span>
                            </div>
                            <div class="cinfo-card-body">
                                <div class="social-list">
                                    <a href="tel:0888796364" class="social-item si-phone">
                                        <div class="social-item-icon"><i class="fas fa-phone-alt"></i></div>
                                        <div>Gọi điện trực tiếp<small>0888 796 364 — 7:00 đến 21:00</small></div>
                                    </a>
                                    <a href="https://zalo.me/0888796364" target="_blank" class="social-item si-zalo">
                                        <div class="social-item-icon"><i class="fas fa-comment-dots"></i></div>
                                        <div>Chat Zalo<small>Phản hồi trong vài phút</small></div>
                                    </a>
                                    <a href="https://facebook.com/mochuongflower" target="_blank" class="social-item si-fb">
                                        <div class="social-item-icon"><i class="fab fa-facebook-f"></i></div>
                                        <div>Facebook<small>facebook.com/mochuongflower</small></div>
                                    </a>
                                    <a href="https://instagram.com/mochuongflower" target="_blank"
                                        class="social-item si-ig" hidden>
                                        <div class="social-item-icon"><i class="fab fa-instagram"></i></div>
                                        <div>Instagram<small>@mochuongflower</small></div>
                                    </a>
                                    <a href="https://tiktok.com/@mochuongflower" target="_blank" class="social-item si-tt" hidden>
                                        <div class="social-item-icon"><i class="fab fa-tiktok"></i></div>
                                        <div>TikTok<small>@mochuongflower</small></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bản đồ --}}
                    <div class="col-lg-4">
                        <div class="cinfo-card" style="overflow:hidden;">
                            <div class="cinfo-card-header">
                                <i class="fas fa-map"></i>
                                <span>Bản đồ</span>
                            </div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.9!2d105.4386824!3d10.3592447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a73000eb67ca7%3A0x27b8740b9e456e9b!2sShop%20Hoa%20M%E1%BB%99c%20H%C6%B0%C6%A1ng!5e0!3m2!1svi!2svn!4v1"
                                style="width:100%;height:340px;border:none;display:block;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ── FEEDBACK ── --}}
        <section class="feedback-section">
            <div class="container">
                <div class="d-flex align-items-end justify-content-between mb-4 flex-wrap gap-3">
                    <div>
                        <div class="section-label">Khách hàng nói gì</div>
                        <h2 class="section-title mb-0">Phản hồi của khách hàng</h2>
                        <div class="divider-leaf"></div>
                    </div>
                    <div class="feedback-nav">
                        <button class="feedback-nav-btn" id="fbPrev" aria-label="Trước">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="feedback-nav-btn" id="fbNext" aria-label="Tiếp">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="feedback-track-wrap">
                    <div class="feedback-track" id="feedbackTrack">

                        {{-- Text feedbacks --}}
                        @php
                            $feedbacks = [
                                ['name' => 'Nguyễn Thị Lan', 'stars' => 5, 'text' => 'Hoa đẹp lắm, tươi và thơm. Giao hàng nhanh, đúng giờ. Lần sau sinh nhật mình sẽ tiếp tục ủng hộ shop!', 'date' => '12/05/2025'],
                                ['name' => 'Trần Minh Tuấn', 'stars' => 5, 'text' => 'Shop tư vấn nhiệt tình, hoa y hình, đóng gói cẩn thận. Bạn gái mình rất thích bó hoa hồng đỏ.', 'date' => '28/04/2025'],
                                ['name' => 'Lê Thị Hoa', 'stars' => 5, 'text' => 'Đặt hoa cưới ở đây, rất hài lòng với dịch vụ và chất lượng. Hoa tươi suốt cả buổi lễ!', 'date' => '15/04/2025'],
                                ['name' => 'Phạm Văn Đức', 'stars' => 4, 'text' => 'Giá cả hợp lý, chất lượng tốt. Nhân viên thân thiện. Sẽ giới thiệu cho bạn bè.', 'date' => '02/04/2025'],
                                ['name' => 'Võ Thị Mai', 'stars' => 5, 'text' => 'Mình order giỏ hoa quà tặng sinh nhật mẹ, shop làm đẹp hơn cả ảnh mẫu! Cảm ơn shop nhiều.', 'date' => '20/03/2025'],
                                ['name' => 'Huỳnh Thanh Tú', 'stars' => 5, 'text' => 'Hoa tươi, bền, thơm. Giao đúng hẹn dù trời mưa. Rất chuyên nghiệp!', 'date' => '08/03/2025'],
                            ];
                        @endphp

                        @foreach($feedbacks as $fb)
                            <div class="feedback-card">
                                <div class="fb-stars">
                                    @for($i = 0; $i < $fb['stars']; $i++)<i class="fas fa-star"></i>@endfor
                                    @for($i = $fb['stars']; $i < 5; $i++)<i class="far fa-star"></i>@endfor
                                </div>
                                <p class="fb-text">"{{ $fb['text'] }}"</p>
                                <div class="fb-author">
                                    <div class="fb-avatar">{{ mb_substr($fb['name'], 0, 1) }}</div>
                                    <div>
                                        <div class="fb-name">{{ $fb['name'] }}</div>
                                        <div class="fb-date">{{ $fb['date'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Ảnh feedback --}}
                        @php
                            $fbImages = [
                                'storage/feedback/fb1.jpg',
                                'storage/feedback/fb2.jpg',
                                'storage/feedback/fb3.jpg',
                            ];
                        @endphp
                        @foreach($fbImages as $img)
                            <div class="feedback-card is-image">
                                <img src="{{ asset($img) }}" alt="Feedback khách hàng"
                                    onerror="this.closest('.feedback-card').style.display='none'">
                                <div class="fb-img-caption">
                                    <i class="fas fa-camera me-1"></i> Ảnh từ khách hàng
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        (function () {
            const track = document.getElementById('feedbackTrack');
            const btnPrev = document.getElementById('fbPrev');
            const btnNext = document.getElementById('fbNext');
            if (!track) return;

            const step = 320; // px mỗi lần bấm

            if (btnNext) btnNext.addEventListener('click', function () {
                track.scrollBy({ left: step, behavior: 'smooth' });
            });
            if (btnPrev) btnPrev.addEventListener('click', function () {
                track.scrollBy({ left: -step, behavior: 'smooth' });
            });

            // Drag to scroll
            let isDown = false, startX, scrollLeft;
            track.addEventListener('mousedown', function (e) { isDown = true; startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft; });
            track.addEventListener('mouseleave', function () { isDown = false; });
            track.addEventListener('mouseup', function () { isDown = false; });
            track.addEventListener('mousemove', function (e) {
                if (!isDown) return;
                e.preventDefault();
                track.scrollLeft = scrollLeft - (e.pageX - track.offsetLeft - startX);
            });
        })();
    </script>
@endsection