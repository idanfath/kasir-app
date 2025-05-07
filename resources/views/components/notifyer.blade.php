@props(['message', 'type' => 'info', 'duration' => 4000])

@php
    $baseColorClasses = '';
    $timerColorClasses = '';
    $textColorClasses = 'text-white'; // Default text color

    switch ($type) {
        case 'error':
            $baseColorClasses = 'bg-red-500';
            $timerColorClasses = 'bg-red-700';
            break;
        case 'success':
            $baseColorClasses = 'bg-green-500';
            $timerColorClasses = 'bg-green-700';
            break;
        case 'info':
        default:
            $baseColorClasses = 'bg-blue-500';
            $timerColorClasses = 'bg-blue-700';
            break;
    }
    $notificationId = 'notification-' . \Illuminate\Support\Str::random(8);
@endphp

<div id="{{ $notificationId }}"
    class="fixed top-4 left-4 {{ $baseColorClasses }} {{ $textColorClasses }} p-4 rounded shadow-lg z-50" role="alert">
    {{ $message }}
    <div class="notification-timer-bar {{ $timerColorClasses }} h-1 absolute bottom-0 left-0" style="width: 100%;"></div>
</div>

<script>
    (function() {
        const notificationElement = document.getElementById('{{ $notificationId }}');
        if (!notificationElement) {
            return;
        }

        const timerElement = notificationElement.querySelector('.notification-timer-bar');
        const notificationDuration = {{ $duration }};
        const updateInterval = 20;
        let currentWidth = 100;
        const widthDecrement = (100 * updateInterval) /
            notificationDuration;

        const intervalId = setInterval(() => {
            currentWidth -= widthDecrement;
            if (timerElement) {
                timerElement.style.width = currentWidth + '%';
            }

            if (currentWidth <= 0) {
                clearInterval(intervalId);
                notificationElement.remove();
            }
        }, updateInterval);

        notificationElement.addEventListener('click', () => {
            clearInterval(intervalId);
            notificationElement.remove();
        }, {
            once: true
        });
    })();
</script>
