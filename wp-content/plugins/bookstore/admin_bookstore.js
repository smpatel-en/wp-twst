const loadBooksByRestButton = document.getElementById("bookstore-load-books");
const booksListContainer = document.getElementById("bookstore-bookslist");

// Using wp.api to get books
if (loadBooksByRestButton) {
  loadBooksByRestButton.addEventListener("click", function () {
    const allBooks = new wp.api.collections.Books();
    allBooks.fetch().done(function (books) {
      books.map((book) => {
        booksListContainer.value +=
          book.title.rendered + ", " + book.link + ",\n";
      });
    });
  });
}

// Using wp.apiFetch to get books
const fetchBooksButton = document.getElementById("bookstore-fetch-books");
if (fetchBooksButton) {
  fetchBooksButton.addEventListener("click", function () {
    wp.apiFetch({ path: "/wp/v2/books" }).then((books) => {
      books.map((book) => {
        booksListContainer.value +=
          book.title.rendered + ", " + book.link + ",\n";
      });
    });
  });
}
