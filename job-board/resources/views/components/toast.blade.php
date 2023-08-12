{{-- <div class="fixed top-4 right-4 py-2 px-4 rounded-md shadow-md"
     id="toastNotification"
     style="background-color: {{ $status === 'success' ? '#34D399' : ($status === 'warning' ? '#FBBF24' : ($status === 'error' ? '#EF4444' : '#333333')) }}">
    <div class="text-white">
        
    </div>
</div>
 --}}

 <div role="alert"
 class="my-8 rounded-md border-l-4 {{ $status === 'error' ? 'border-red-300 bg-red-100 text-red-700' : 'border-green-300 bg-green-100 text-green-700' }} p-4 opacity-75">
<p class="font-bold">{{ Str::ucfirst($status) }}!</p>
<p>{{ $message }}</p>
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
