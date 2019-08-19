function deleteButton(id){
    var result = confirm("Bạn có chắc muốn xóa?");
    if (result) {
        document.getElementById(id).submit();
    }
}
