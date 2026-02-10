<script>
$(document).ready(function() {
    // Manejar clic en botón de video
    $('.btn-view-video').click(function() {
        const videoUrl = $(this).data('video-url');
        const embedUrl = convertToEmbedUrl(videoUrl);
        
        $('#videoFrame').attr('src', embedUrl);
        $('#videoModal').modal('show');
    });

    // Limpiar iframe al cerrar el modal
    $('#videoModal').on('hidden.bs.modal', function() {
        $('#videoFrame').attr('src', '');
    });

    // Función para convertir URLs normales a embed
    function convertToEmbedUrl(url) {
        // Si es YouTube
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);
            const videoId = (match && match[2].length === 11) ? match[2] : null;
            return videoId ? `https://www.youtube.com/embed/${videoId}` : url;
        }
        
        // Si es Vimeo
        if (url.includes('vimeo.com')) {
            const regExp = /^.*(vimeo.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
            const match = url.match(regExp);
            const videoId = match ? match[5] : null;
            return videoId ? `https://player.vimeo.com/video/${videoId}` : url;
        }
        
        // Si es otro tipo de URL, devolverla tal cual
        return url;
    }
});
</script>