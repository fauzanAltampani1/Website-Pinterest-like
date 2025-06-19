function toggleLike(button) {
    const postId = button.getAttribute('data-post-id');
    const likeCount = document.getElementById(`like-count-${postId}`);
    const heartIcon = button.querySelector('i');

    fetch(`/like/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        likeCount.textContent = data.count; // Update jumlah likes
        if (data.isLiked) {
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas', 'text-red-500'); // Ikon hati penuh
        } else {
            heartIcon.classList.remove('fas', 'text-red-500');
            heartIcon.classList.add('far'); // Ikon hati kosong
        }
    })
    .catch(error => console.error('Error:', error));
}
