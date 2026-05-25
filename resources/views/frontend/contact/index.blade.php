@extends('layouts.frontend.app')

@section('title', 'Liên hệ')

@section('content')
<style>
    /* ─── CONTACT PAGE ─── */
    .contact-page { background: var(--cream); }

    /* ─── HERO ─── */
    .contact-hero {
        background: linear-gradient(135deg, #1a6b6e 0%, #2BAAAD 50%, #3dc4c8 100%);
        padding: 56px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/svg%3E") repeat;
    }
    .contact-hero-logo {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,.4);
        box-shadow: 0 8px 28px rgba(0,0,0,.18);
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        color: #fff;
        font-size: clamp(1.6rem, 4vw, 2.4rem);
        font-weight: 700;
        position: relative;
        z-index: 1;
        margin-bottom: 8px;
    }
    .contact-hero h1 em { color: #8dd5d7; font-style: italic; }
    .contact-hero p {
        color: #b2e8ea;
        font-size: 0.92rem;
        position: relative;
        z-index: 1;
        margin: 0;
    }

    /* ─── WAVE ─── */
    .contact-wave {
        margin-top: -2px;
        line-height: 0;
        background: var(--green-dark);
    }
    .contact-wave svg { display: block; }

    /* ─── LAYOUT ─── */
    .contact-body { padding: 48px 0 64px; }

    /* ─── INFO CARDS ─── */
    .contact-info-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid #e8f5f5;
        padding: 28px 24px;
        height: 100%;
    }
    .contact-info-card h5 {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--green-pale);
    }

    .contact-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 16px;
    }
    .contact-row:last-child { margin-bottom: 0; }
    .contact-row-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--green-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: var(--green-main);
        flex-shrink: 0;
    }
    .contact-row-text strong {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 2px;
    }
    .contact-row-text span,
    .contact-row-text a {
        font-size: 0.88rem;
        color: var(--text-dark);
        text-decoration: none;
        line-height: 1.5;
    }
    .contact-row-text a:hover { color: var(--green-main); }

    /* ─── SOCIAL BUTTONS ─── */
    .contact-socials {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 4px;
    }
    .contact-social-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all .2s;
        border: 1.5px solid transparent;
    }
    .contact-social-btn i { font-size: 1.2rem; }
    .contact-social-btn .csb-meta { font-size: 0.72rem; font-weight: 400; opacity: .8; display: block; }

    .csb-phone {
        background: #e8f5e9;
        color: #1b5e20;
        border-color: #c8e6c9;
    }
    .csb-phone:hover { background: #1b5e20; color: #fff; }

    .csb-zalo {
        background: #e3f2fd;
        color: #0d47a1;
        border-color: #bbdefb;
    }
    .csb-zalo:hover { background: #0d47a1; color: #fff; }

    .csb-facebook {
        background: #e8eaf6;
        color: #1565c0;
        border-color: #c5cae9;
    }
    .csb-facebook:hover { background: #1565c0; color: #fff; }

    .csb-instagram {
        background: #fce4ec;
        color: #880e4f;
        border-color: #f8bbd0;
    }
    .csb-instagram:hover { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); color: #fff; }

    .csb-tiktok {
        background: #f3e5f5;
        color: #4a148c;
        border-color: #e1bee7;
    }
    .csb-tiktok:hover { background: #111; color: #fff; }

    /* ─── MAP ─── */
    .contact-map {
        border-radius: 20px;
        overflow: hidden;
        border: 1.5px solid #e8f5f5;
        height: 280px;
    }
    .contact-map iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    /* ─── FORM ─── */
    .contact-form-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid #e8f5f5;
        padding: 32px 28px;
    }
    .contact-form-card h5 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 6px;
    }
    .contact-form-card .subtitle {
        font-size: 0.84rem;
        color: var(--text-muted);
        margin-bottom: 24px;
    }

    .contact-form-card .form-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
    }
    .contact-form-card .form-control,
    .contact-form-card .form-select {
        border: 1.5px solid #b2e8ea;
        border-radius: 10px;
        font-size: 0.875rem;
        color: var(--text-dark);
        transition: border-color .2s, box-shadow .2s;
    }
    .contact-form-card .form-control:focus,
    .contact-form-card .form-select:focus {
        border-color: var(--green-main);
        box-shadow: 0 0 0 3px rgba(43,170,173,.12);
    }
    .contact-form-card textarea { resize: none; }

    /* Star rating */
    .star-rating { display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end; }
    .star-rating input { display: none; }
    .star-rating label {
        font-size: 1.6rem;
        color: #d0ecee;
        cursor: pointer;
        transition: color .15s;
        line-height: 1;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: var(--gold);
    }

    /* Submit btn */
    .contact-form-card .btn-submit {
        background: var(--green-main);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 13px 36px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all .25s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .contact-form-card .btn-submit:hover {
        background: var(--green-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(43,170,173,.3);
    }

    /* ─── HOURS ─── */
    .hours-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.83rem;
        padding: 6px 0;
        border-bottom: 1px solid #f0f9f9;
        color: var(--text-muted);
    }
    .hours-row:last-child { border-bottom: none; }
    .hours-row strong { color: var(--text-dark); }
    .hours-row .open { color: var(--green-main); font-weight: 600; }

    @media (max-width: 767px) {
        .contact-hero { padding: 40px 0 60px; }
        .contact-form-card { padding: 20px 16px; }
        .contact-info-card { padding: 20px 16px; }
    }
</style>

<div class="contact-page">

    {{-- ── Hero ── --}}
    <div class="contact-hero">
        <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Mộc Hương" class="contact-hero-logo">
        <h1>Mộc <em>Hương</em> Flower</h1>
        <p>Chúng tôi luôn sẵn sàng lắng nghe & hỗ trợ bạn</p>
    </div>

  

    {{-- ── Body ── --}}
    <div class="contact-body">
        <div class="container">
            <div class="row g-4">

                {{-- ── Cột trái: thông tin ── --}}
                <div class="col-lg-5 d-flex flex-column gap-4">

                    {{-- Thông tin liên hệ --}}
                    <div class="contact-info-card">
                        <h5><i class="bi bi-info-circle me-2" style="color:var(--green-main)"></i>Thông tin liên hệ</h5>

                        <div class="contact-row">
                            <div class="contact-row-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="contact-row-text">
                                <strong>Địa chỉ</strong>
                                <span>Số 223, đường cặp rạch Gòi Lớn, khóm Mỹ Phú,<br>phường Long Xuyên, tỉnh An Giang</span>
                            </div>
                        </div>

                        <div class="contact-row">
                            <div class="contact-row-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div class="contact-row-text">
                                <strong>Điện thoại</strong>
                                <a href="tel:0888796364">0888 796 364</a>
                            </div>
                        </div>

                        <div class="contact-row">
                            <div class="contact-row-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div class="contact-row-text">
                                <strong>Email</strong>
                                <a href="mailto:mochuongflower@gmail.com">mochuongflower@gmail.com</a>
                            </div>
                        </div>

                        <div class="contact-row">
                            <div class="contact-row-icon"><i class="bi bi-clock-fill"></i></div>
                            <div class="contact-row-text">
                                <strong>Giờ mở cửa</strong>
                                <span>Thứ 2 – Chủ nhật: 7:00 – 21:00</span>
                            </div>
                        </div>
                    </div>

                    {{-- Kênh liên hệ --}}
                    <div class="contact-info-card">
                        <h5><i class="bi bi-share me-2" style="color:var(--green-main)"></i>Kênh liên hệ</h5>
                        <div class="contact-socials">
                            <a href="tel:0888796364" class="contact-social-btn csb-phone">
                                <i class="bi bi-telephone-fill"></i>
                                <div>Gọi điện trực tiếp<span class="csb-meta">0888 796 364 — hỗ trợ 7:00–21:00</span></div>
                            </a>
                            <a href="https://zalo.me/0888796364" target="_blank" class="contact-social-btn csb-zalo">
                                <i class="bi bi-chat-dots-fill"></i>
                                <div>Chat Zalo<span class="csb-meta">Phản hồi nhanh trong vài phút</span></div>
                            </a>
                            <a href="https://facebook.com/mochuongflower" target="_blank" class="contact-social-btn csb-facebook">
                                <i class="bi bi-facebook"></i>
                                <div>Facebook<span class="csb-meta">facebook.com/mochuongflower</span></div>
                            </a>
                            <a href="https://instagram.com/mochuongflower" target="_blank" class="contact-social-btn csb-instagram">
                                <i class="bi bi-instagram"></i>
                                <div>Instagram<span class="csb-meta">@mochuongflower</span></div>
                            </a>
                            <a href="https://tiktok.com/@mochuongflower" target="_blank" class="contact-social-btn csb-tiktok">
                                <i class="bi bi-tiktok"></i>
                                <div>TikTok<span class="csb-meta">@mochuongflower</span></div>
                            </a>
                        </div>
                    </div>

                    {{-- Bản đồ --}}
                    <div class="contact-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.4!2d105.435!3d10.387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDIzJzEzLjIiTiAxMDXCsDI2JzA2LjAiRQ!5e0!3m2!1svi!2svn!4v1"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>

                {{-- ── Cột phải: form feedback ── --}}
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <h5>📝 Gửi phản hồi cho chúng tôi</h5>
                        <p class="subtitle">Ý kiến của bạn giúp Mộc Hương ngày càng hoàn thiện hơn.</p>

                        @if(session('success'))
                            <div class="alert alert-success rounded-3 mb-4" style="font-size:.875rem;">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        <form action="" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Nguyễn Văn A">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" placeholder="0888 xxx xxx">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="email@example.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Chủ đề</label>
                                    <select name="subject" class="form-select">
                                        <option value="">-- Chọn chủ đề --</option>
                                        <option value="order" {{ old('subject') === 'order' ? 'selected' : '' }}>Đặt hàng & giao hàng</option>
                                        <option value="product" {{ old('subject') === 'product' ? 'selected' : '' }}>Tư vấn sản phẩm</option>
                                        <option value="feedback" {{ old('subject') === 'feedback' ? 'selected' : '' }}>Phản hồi dịch vụ</option>
                                        <option value="partner" {{ old('subject') === 'partner' ? 'selected' : '' }}>Hợp tác kinh doanh</option>
                                        <option value="other" {{ old('subject') === 'other' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                </div>

                                {{-- Đánh giá sao --}}
                                <div class="col-12">
                                    <label class="form-label">Đánh giá trải nghiệm</label>
                                    <div class="star-rating">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                                {{ old('rating') == $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}">★</label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                                    <textarea name="message" rows="5"
                                        class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Chia sẻ cảm nhận, góp ý hoặc câu hỏi của bạn...">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn-submit">
                                        <i class="bi bi-send"></i> Gửi phản hồi
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{-- Giờ làm việc --}}
                        <div class="mt-4 pt-4" style="border-top:1.5px solid #e8f5f5;">
                            <p style="font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--text-muted);margin-bottom:12px;">
                                <i class="bi bi-clock me-1" style="color:var(--green-main)"></i>Giờ làm việc
                            </p>
                            <div class="hours-row"><strong>Thứ 2 – Thứ 6</strong><span class="open">7:00 – 21:00</span></div>
                            <div class="hours-row"><strong>Thứ 7</strong><span class="open">7:00 – 21:00</span></div>
                            <div class="hours-row"><strong>Chủ nhật</strong><span class="open">8:00 – 20:00</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection