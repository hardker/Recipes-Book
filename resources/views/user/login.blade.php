@extends('shablons.shablon-main')
@section('titles', 'Авторизация')
@section('styles')
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        #Caps_lock {display:none}

        /* .form-signin .form-floating:focus-within {z-index: 2;}*/
    </style>
@endsection

@section('main_content')
    <div class="form-signin w-100 m-auto">
        <form action="{{ route('login.auth') }}" method="post">
            <h1 class="h3 mb-3 fw-normal text-center">АВТОРИЗАЦИЯ</h1>
            @csrf

            <div class="form-floating ">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="email">Адрес электронной почты</label>
            </div>
            <div class="text-danger text-center">
                @if (Session::has('msg_error'))
                    {!! session('msg_error') !!}
                @endif
                <p id="Caps_lock" class="my-0">Внимание! Caps lock включен.</p>
            </div>
            <div class="form-floating mt-2">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Пароль</label>
            </div>
            <div class="form-check text-start mb-3">
                <input name="remember" class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">
                    Запомнить меня
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" class="btn btn-primary">ВХОД</button>
        </form>
        <div class="py-1 d-flex align-items-center">
            <hr class="flex-grow-1" />
            <div class="badge bg-secondary">ИЛИ ВВОЙТИ ЧЕРЕЗ</div>
            <hr class="flex-grow-1" />
        </div>

        <!-- Авторизация через соц.сети -->
        <!-- кнопка яндекса -->
        <div class="d-flex justify-content-center">
            <a href="{{ route('yandex') }}" class="btn">

                <svg width="300" height="auto" viewBox="0 0 280 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 24C0 12.6863 0 7.02944 3.51472 3.51472C7.02944 0 12.6863 0 24 0H256C267.314 0 272.971 0 276.485 3.51472C280 7.02944 280 12.6863 280 24V32C280 43.3137 280 48.9706 276.485 52.4853C272.971 56 267.314 56 256 56H24C12.6863 56 7.02944 56 3.51472 52.4853C0 48.9706 0 43.3137 0 32V24Z"
                        fill="black"></path>
                    <rect x="54" y="16" width="24" height="24" rx="12" fill="#FC3F1D"></rect>
                    <path
                        d="M67.6911 35.212H70.1981V20.812H66.5515C62.8841 20.812 60.9572 22.6975 60.9572 25.4739C60.9572 27.6909 62.0139 28.9962 63.8994 30.3429L60.6257 35.212H63.34L66.9866 29.7628L65.7227 28.9133C64.1895 27.8773 63.4436 27.0693 63.4436 25.3288C63.4436 23.7956 64.521 22.7596 66.5722 22.7596H67.6911V35.212Z"
                        fill="white"></path>
                    <path
                        d="M91.396 21.528H95.3C96.6653 21.528 97.7053 21.7413 98.42 22.168C99.1347 22.5947 99.492 23.3147 99.492 24.328C99.492 24.744 99.4333 25.1067 99.316 25.416C99.1987 25.7147 99.028 25.976 98.804 26.2C98.5907 26.4133 98.3293 26.5893 98.02 26.728C97.7107 26.8667 97.3693 26.9733 96.996 27.048C97.956 27.1653 98.6813 27.4267 99.172 27.832C99.6627 28.2373 99.908 28.856 99.908 29.688C99.908 30.2853 99.7907 30.7973 99.556 31.224C99.3213 31.64 98.996 31.9813 98.58 32.248C98.164 32.504 97.6733 32.696 97.108 32.824C96.5427 32.9413 95.9293 33 95.268 33H91.396V21.528ZM93.332 23.208V26.264H95.396C96.036 26.264 96.5533 26.1307 96.948 25.864C97.3427 25.5867 97.54 25.1547 97.54 24.568C97.54 24.0347 97.3587 23.6773 96.996 23.496C96.644 23.304 96.1427 23.208 95.492 23.208H93.332ZM93.332 27.928V31.336H95.46C95.8227 31.336 96.1533 31.3093 96.452 31.256C96.7507 31.192 97.0067 31.096 97.22 30.968C97.4333 30.8293 97.5987 30.6533 97.716 30.44C97.8333 30.216 97.892 29.944 97.892 29.624C97.892 28.9947 97.684 28.5573 97.268 28.312C96.8627 28.056 96.2067 27.928 95.3 27.928H93.332Z"
                        fill="white"></path>
                    <path
                        d="M105.273 33.16C104.686 33.16 104.142 33.064 103.641 32.872C103.139 32.68 102.702 32.4027 102.329 32.04C101.966 31.6667 101.678 31.2133 101.465 30.68C101.262 30.1467 101.161 29.5333 101.161 28.84C101.161 28.1467 101.262 27.5333 101.465 27C101.678 26.4667 101.966 26.0187 102.329 25.656C102.702 25.2827 103.139 25.0053 103.641 24.824C104.142 24.632 104.686 24.536 105.273 24.536C105.859 24.536 106.403 24.632 106.905 24.824C107.406 25.0053 107.843 25.2827 108.217 25.656C108.59 26.0187 108.883 26.4667 109.097 27C109.31 27.5333 109.417 28.1467 109.417 28.84C109.417 29.5333 109.31 30.1467 109.097 30.68C108.883 31.2133 108.59 31.6667 108.217 32.04C107.843 32.4027 107.406 32.68 106.905 32.872C106.403 33.064 105.859 33.16 105.273 33.16ZM105.273 31.608C105.913 31.608 106.441 31.384 106.857 30.936C107.283 30.488 107.497 29.7893 107.497 28.84C107.497 27.9013 107.283 27.208 106.857 26.76C106.441 26.3013 105.913 26.072 105.273 26.072C104.643 26.072 104.115 26.3013 103.689 26.76C103.273 27.208 103.065 27.9013 103.065 28.84C103.065 29.7893 103.273 30.488 103.689 30.936C104.115 31.384 104.643 31.608 105.273 31.608Z"
                        fill="white"></path>
                    <path
                        d="M114.714 23.704C114.266 23.704 113.876 23.6453 113.546 23.528C113.226 23.4107 112.954 23.2507 112.73 23.048C112.516 22.8347 112.356 22.5893 112.25 22.312C112.143 22.024 112.09 21.72 112.09 21.4H113.722C113.722 21.7733 113.807 22.0453 113.978 22.216C114.159 22.376 114.404 22.456 114.714 22.456C115.023 22.456 115.263 22.376 115.434 22.216C115.604 22.0453 115.69 21.7733 115.69 21.4H117.338C117.338 21.72 117.284 22.024 117.178 22.312C117.071 22.5893 116.906 22.8347 116.682 23.048C116.468 23.2507 116.196 23.4107 115.866 23.528C115.535 23.6453 115.151 23.704 114.714 23.704ZM112.81 30.488L116.65 24.696H118.474V33H116.634V27.24L112.826 33H110.97V24.696H112.81V30.488Z"
                        fill="white"></path>
                    <path d="M124.275 26.2V33H122.419V26.2H119.907V24.696H126.835V26.2H124.275Z" fill="white"></path>
                    <path d="M130.091 30.488L133.931 24.696H135.755V33H133.915V27.24L130.107 33H128.251V24.696H130.091V30.488Z" fill="white"></path>
                    <path
                        d="M145.184 33.16C144.512 33.16 143.91 33.064 143.376 32.872C142.843 32.6693 142.39 32.3867 142.016 32.024C141.643 31.6507 141.355 31.1973 141.152 30.664C140.95 30.1307 140.848 29.5227 140.848 28.84C140.848 28.168 140.95 27.5653 141.152 27.032C141.355 26.4987 141.643 26.0507 142.016 25.688C142.39 25.3147 142.848 25.032 143.392 24.84C143.936 24.6373 144.544 24.536 145.216 24.536C145.792 24.536 146.294 24.6 146.72 24.728C147.158 24.856 147.504 25.016 147.76 25.208V26.744C147.43 26.5307 147.067 26.3653 146.672 26.248C146.288 26.1307 145.84 26.072 145.328 26.072C143.611 26.072 142.752 26.9947 142.752 28.84C142.752 30.6853 143.595 31.608 145.28 31.608C145.824 31.608 146.288 31.5493 146.672 31.432C147.067 31.304 147.43 31.144 147.76 30.952V32.488C147.483 32.6693 147.136 32.8293 146.72 32.968C146.304 33.096 145.792 33.16 145.184 33.16Z"
                        fill="white"></path>
                    <path
                        d="M153.097 25.128C153.097 24.52 153.204 23.992 153.417 23.544C153.631 23.0853 153.929 22.712 154.313 22.424C154.697 22.1253 155.156 21.9013 155.689 21.752C156.233 21.6027 156.836 21.528 157.497 21.528H161.225V33H159.273V28.584H157.497L154.569 33H152.313L155.545 28.296C154.713 28.0933 154.095 27.7253 153.689 27.192C153.295 26.648 153.097 25.96 153.097 25.128ZM159.273 26.968V23.208H157.481C156.756 23.208 156.175 23.352 155.737 23.64C155.311 23.9173 155.097 24.3973 155.097 25.08C155.097 25.752 155.289 26.2373 155.673 26.536C156.057 26.824 156.601 26.968 157.305 26.968H159.273Z"
                        fill="white"></path>
                    <path d="M168.845 29.496H165.341V33H163.485V24.696H165.341V27.992H168.845V24.696H170.701V33H168.845V29.496Z" fill="white"></path>
                    <path
                        d="M172.558 31.496C172.803 31.2827 172.995 30.9893 173.134 30.616C173.283 30.2427 173.401 29.7787 173.486 29.224C173.571 28.6587 173.635 28.0027 173.678 27.256C173.721 26.5093 173.758 25.656 173.79 24.696H179.87V31.496H181.118V35.368H179.502L179.358 33H173.63L173.486 35.368H171.854V31.496H172.558ZM178.014 31.496V26.2H175.39C175.337 27.512 175.246 28.6 175.118 29.464C175.001 30.3173 174.803 30.9947 174.526 31.496H178.014Z"
                        fill="white"></path>
                    <path
                        d="M189.273 32.392C189.156 32.4667 189.012 32.552 188.841 32.648C188.67 32.7333 188.468 32.8133 188.233 32.888C187.998 32.9627 187.726 33.0267 187.417 33.08C187.108 33.1333 186.756 33.16 186.361 33.16C184.836 33.16 183.694 32.7813 182.937 32.024C182.19 31.2667 181.817 30.2053 181.817 28.84C181.817 28.168 181.918 27.5653 182.121 27.032C182.324 26.4987 182.606 26.0507 182.969 25.688C183.332 25.3147 183.764 25.032 184.265 24.84C184.766 24.6373 185.316 24.536 185.913 24.536C186.532 24.536 187.086 24.6373 187.577 24.84C188.078 25.0427 188.489 25.3467 188.809 25.752C189.129 26.1573 189.348 26.6587 189.465 27.256C189.593 27.8533 189.598 28.552 189.481 29.352H183.737C183.812 30.1093 184.062 30.68 184.489 31.064C184.916 31.4373 185.582 31.624 186.489 31.624C187.15 31.624 187.7 31.544 188.137 31.384C188.585 31.2133 188.964 31.0373 189.273 30.856V32.392ZM185.913 26.008C185.369 26.008 184.91 26.1733 184.537 26.504C184.164 26.8347 183.918 27.3253 183.801 27.976H187.705C187.726 27.304 187.577 26.808 187.257 26.488C186.937 26.168 186.489 26.008 185.913 26.008Z"
                        fill="white"></path>
                    <path
                        d="M193.78 29.624H193.06V33H191.204V24.696H193.06V28.12H193.844L196.484 24.696H198.436L195.3 28.696L198.564 33H196.372L193.78 29.624Z"
                        fill="white"></path>
                    <path
                        d="M203.231 33.16C202.559 33.16 201.956 33.064 201.423 32.872C200.89 32.6693 200.436 32.3867 200.063 32.024C199.69 31.6507 199.402 31.1973 199.199 30.664C198.996 30.1307 198.895 29.5227 198.895 28.84C198.895 28.168 198.996 27.5653 199.199 27.032C199.402 26.4987 199.69 26.0507 200.063 25.688C200.436 25.3147 200.895 25.032 201.439 24.84C201.983 24.6373 202.591 24.536 203.263 24.536C203.839 24.536 204.34 24.6 204.767 24.728C205.204 24.856 205.551 25.016 205.807 25.208V26.744C205.476 26.5307 205.114 26.3653 204.719 26.248C204.335 26.1307 203.887 26.072 203.375 26.072C201.658 26.072 200.799 26.9947 200.799 28.84C200.799 30.6853 201.642 31.608 203.327 31.608C203.871 31.608 204.335 31.5493 204.719 31.432C205.114 31.304 205.476 31.144 205.807 30.952V32.488C205.53 32.6693 205.183 32.8293 204.767 32.968C204.351 33.096 203.839 33.16 203.231 33.16Z"
                        fill="white"></path>
                    <path d="M213.16 21.528V33H211.224V21.528H213.16Z" fill="white"></path>
                    <path
                        d="M215.615 21.528H219.487C220.297 21.528 221.049 21.6187 221.743 21.8C222.447 21.9813 223.055 22.28 223.567 22.696C224.089 23.112 224.495 23.6613 224.783 24.344C225.081 25.0267 225.231 25.8693 225.231 26.872C225.231 27.8853 225.081 28.776 224.783 29.544C224.495 30.3013 224.084 30.936 223.551 31.448C223.028 31.96 222.404 32.3493 221.679 32.616C220.964 32.872 220.18 33 219.327 33H215.615V21.528ZM217.551 23.208V31.336H219.391C219.956 31.336 220.468 31.2507 220.927 31.08C221.396 30.9093 221.796 30.648 222.127 30.296C222.468 29.944 222.729 29.496 222.911 28.952C223.103 28.3973 223.199 27.7413 223.199 26.984C223.199 26.2373 223.108 25.624 222.927 25.144C222.745 24.6533 222.489 24.264 222.159 23.976C221.839 23.688 221.455 23.4907 221.007 23.384C220.559 23.2667 220.073 23.208 219.551 23.208H217.551Z"
                        fill="white"></path>
                </svg>
                {{-- <img class="img-fluid"  src="https://doc-binary.s3.yandex.net/src/dev/id/logo-oauth-doc.svg" alt="Logo" > --}}
            </a>
        </div>
        <div class="d-flex justify-content-center">
            {!! Socialite::driver('telegram')->getButton() !!}
        </div>
    </div>

    @if (Session::has('msg_error'))
        <!-- Всплывающее сообщение-->
        <div id="errorToast" class="toast fade hide toast-container position-fixed start-0 top-0 p-2 text-bg-danger border-0 m-5" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
            <div class="d-flex ">
                <div class="toast-body">
                    <strong>&#128274; ОШИБКА &#128274;</strong><br>
                    {!! session('msg_error') !!}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
            </div>
        </div>
        <script>
            const toastBtstr = bootstrap.Toast.getOrCreateInstance(document.getElementById('errorToast'))
            toastBtstr.show()
        </script>
    @endif
    <script>
        // Получить поле ввода
        var input = document.getElementById("password");
        // Получить текст предупреждения
        var text = document.getElementById("Caps_lock");
        // Когда пользователь нажимает любую клавишу, запустить функцию
        input.addEventListener("keyup", function(event) {
            // Если Caps Lock нажат, отобразится текст предупреждения
            if (event.getModifierState("CapsLock")) {
                text.style.display = "block";
            } else {
                text.style.display = "none"
            }
        });
    </script>
@endsection
