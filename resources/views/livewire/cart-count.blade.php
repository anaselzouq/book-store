<div>
    <li wire:poll.1s class="ms-3 position-relative text-center" style="width: 60px;">
        <a href="/cart" class="d-inline-block position-relative" style="width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" style="stroke:none !important"
                        fill="currentColor" viewBox="0 0 24 24">
                        <!--Boxicons v3.0 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path
                            d="M10.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M8.82 15.77c.31.75 1.04 1.23 1.85 1.23h6.18c.79 0 1.51-.47 1.83-1.2l3.24-7.4c.14-.31.11-.67-.08-.95S21.34 7 21 7H7.33L5.92 3.62C5.76 3.25 5.4 3 5 3H2v2h2.33zM19.47 9l-2.62 6h-6.18l-2.5-6z">
                        </path>
                    </svg>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $count == 0 ? 'd-none' : '' }}"
                style="font-size: 0.75rem;">
                {{ $count }}
            </span>
            <div class="txt-span" style="display: block; margin-top: 5px;">المشتريات</div>
        </a>
    </li>

</div>
