<div class="popup-wrap message type-header">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="header-item">
                <span class="text-tiny">{{ $newCount }}</span>
                <i class="icon-bell"></i>
            </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
            <li>
                <h6>Notifications</h6>
            </li>
            @foreach ($notifications as $notification)
                <li>
                    <div class="{{ $notification->data['box_color'] }}">
                        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}">
                            <div class="image">
                                <i class="{{ $notification->data['icon'] }}"></i>
                            </div>
                        </a>
                        <div>
                            <div class="body-title-2">{{ $notification->data['title'] }}
                                <span
                                    @if ($notification->read()) style="color: black" @endif>{{ $notification->data['order_id'] }}</span>
                            </div>
                            <div class="text-tiny">{{ $notification->data['body'] }}
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            <li><a href="#" class="tf-button w-full">View all</a></li>
        </ul>
    </div>
</div>
