$(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();  // Lấy từ khóa tìm kiếm

        if (query.length > 2) {  // Chỉ tìm kiếm khi từ khóa dài hơn 2 ký tự
            $.ajax({
                url: "{{ route('search.suggestions') }}",  // Đường dẫn đến route tìm kiếm
                method: "GET",
                data: { query: query },  // Gửi từ khóa tìm kiếm tới backend
                success: function(data) {
                    $('#search-suggestions').empty();  // Xóa kết quả cũ trước khi hiển thị kết quả mới
                    if (data.length > 0) {
                        // Duyệt qua kết quả và hiển thị dưới dạng gợi ý
                        data.forEach(function(product) {
                            $('#search-suggestions').append('<div><a href="/product/' + product.slug + '">' + product.name + '</a></div>');
                        });
                    } else {
                        $('#search-suggestions').append('<div>Không có kết quả</div>');
                    }
                }
            });
        } else {
            // Nếu từ khóa quá ngắn, xóa kết quả tìm kiếm
            $('#search-suggestions').empty();
        }
    });
});
