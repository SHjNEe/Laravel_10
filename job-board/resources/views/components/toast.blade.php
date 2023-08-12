<div class="fixed top-4 right-4 py-2 px-4 rounded-md shadow-md"
     id="toastNotification"
     style="background-color: {{ $status === 'success' ? '#34D399' : ($status === 'warning' ? '#FBBF24' : ($status === 'error' ? '#EF4444' : '#333333')) }}">
    <div class="text-white">
        {{ $message }}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toastElement = document.getElementById("toastNotification");
        
        if (toastElement) {
            const duration = 3000; // 3000 milliseconds = 3 seconds
            
            setTimeout(function() {
                toastElement.remove();
            }, duration);
        }
    });
</script>
