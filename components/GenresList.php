<?php
include 'bootstrap.html';
?>

<form method="post">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" name="GenresList" id="exampleFormControlSelect1">
            <option>Усі книги</option>
            <option>Детектив</option>
            <option>Трилер</option>
            <option>Фантастика</option>
            <option>Жахи</option>
            <option>Фентезі</option>
            <option>Драма</option>
            <option>Наука</option>
            <option>Інше</option>
        </select>
        <input class="form-control mr-sm-2" type="search" name="SearchBookForm" placeholder="Search"
               aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" name="SubmitSearchBook" type="submit=">Search</button>
    </div>
</form>