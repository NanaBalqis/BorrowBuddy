  <!-- ***** Main Banner Area Start ***** -->
  <div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="header-text">
            <h6>Library Book Borrowing and Rental System</h6>
            <h2>Borrow, Rent, Collect &amp; Read Your Fav Book.</h2>
            <p>BorrowBuddy is the smarter way to manage school libraries. It replaces manual book records with a fast, digital system for borrowing, returning, and tracking books. Students can search and reserve titles online, while librarians get real-time tools to manage inventory and reduce errors — all in one easy platform.</p>
            <div class="buttons">
              <div class="border-button">
                <a href="#">Browse Books</a>
              </div>
              <div class="main-button">
                <a href="https://youtube.com/templatemo" target="_blank">Watch Our Videos</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <div class="owl-banner owl-carousel">
            <div class="item">
              <img src="/assets/images/banner-01.png" alt="">
            </div>
            <div class="item">
              <img src="/assets/images/banner-02.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Main Banner Area End ***** -->
  
  <div class="categories-collections" id="categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="categories">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <div class="line-dec"></div>
                  <h2>Browse Through Our <em>Categories</em> Here.</h2>
                </div>
              </div>
              <div class="row justify-content-center">
                <?php if (!empty($genres)) : ?>
                  <?php foreach ($genres as $index => $genre) :
                    $name = trim($genre['genre'] ?? '');
                    if ($name === '') continue;

                    $iconClass = match (strtolower($name)) {
                      'romance'       => 'fa-heart',
                      'fiction'       => 'fa-book-open',
                      'science'       => 'fa-flask',
                      'fantasy'       => 'fa-hat-wizard',
                      'biography'     => 'fa-user',
                      'children'      => 'fa-child',
                      default         => 'fa-book',
                    };
                  ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-10 mb-4">
                      <div class="item text-center p-4 shadow" style="background-color:#1a1a1a; border-radius: 20px;">
                        <div class="icon mb-3">
                          <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                            <i class="fa <?= $iconClass ?> fa-lg text-purple"></i>
                          </div>
                        </div>
                        <h4 class="text-white mb-2"><?= esc($name) ?></h4>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else : ?>
                  <p class="text-muted text-center">No categories found.</p>
                <?php endif; ?>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="create-nft" id="feedback">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>What Our Readers Say</h2>
          </div>
        </div>
        <div class="col-lg-4 text-end">
          <div class="main-button">
            <a href="#">Share Your Feedback</a>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="item first-item">
            <div class="icon mb-3">
              <i class="fa fa-user-circle fa-2x text-purple"></i>
            </div>
            <h4>Amazing Collection</h4>
            <p>"BorrowBuddy helped me discover some amazing books I wouldn't have found elsewhere!"</p>
            <p class="text">— Sara M., Member</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="item second-item">
            <div class="icon mb-3">
              <i class="fa fa-book-reader fa-2x text-purple"></i>
            </div>
            <h4>Easy Rental Process</h4>
            <p>"Renting and returning books has never been this smooth. Love the system!"</p>
            <p class="text">— Daniel W., College Student</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="item">
            <div class="icon mb-3">
              <i class="fa fa-star fa-2x text-purple"></i>
            </div>
            <h4>Highly Recommended</h4>
            <p>"A perfect platform for any school library. The late fee reminders are super helpful!"</p>
            <p class="text">— Mrs. Aina, Librarian</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="currently-market" id="items">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2><em>Books</em> Currently In The Library.</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="filters">
            <ul>
              <li data-filter="*" class="active">All Books</li>
              <?php if (!empty($genres)) : ?>
                <?php foreach ($genres as $genre) :
                  $genreSlug = strtolower(str_replace(' ', '-', $genre['genre']));
                ?>
                  <li data-filter=".<?= esc($genreSlug) ?>"><?= esc($genre['genre']) ?></li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="row grid">
            <?php if (!empty($books)) : ?>
              <?php foreach ($books as $book) : ?>
                <?php
                  $genreClass = strtolower(str_replace(' ', '-', $book['genre'] ?? 'misc'));
                  $image = $book['book_cover'] ?: '/assets/images/market-01.jpg';
                ?>
                <div class="col-lg-6 currently-market-item all <?= esc($genreClass) ?>">
                  <div class="item d-flex align-items-start gap-3" style="min-height: 240px;">
                    <div class="left-image flex-shrink-0">
                      <img src="<?= base_url($image) ?>" alt="<?= esc($book['title']) ?>" 
                          style="border-radius: 15px; max-width: 160px; height: 220px; object-fit: cover;">
                    </div>
                    <div class="right-content flex-grow-1">
                      <?php
                        $title = esc($book['title']);
                        $shortTitle = strlen($title) > 20 ? substr($title, 0, 20) . '...' : $title;
                      ?>
                      <h4><?= $shortTitle ?></h4>
                      <span class="author d-flex align-items-center gap-2 mb-2">
                        <img src="/assets/images/author.jpg" alt="author" style="width: 40px; height: 40px; border-radius: 50%;">
                        <h6 class="m-0"><?= esc($book['author']) ?><br>
                          <a href="#">@<?= strtolower(str_replace(' ', '', $book['author'])) ?></a>
                        </h6>
                      </span>
                      <div class="line-dec my-2"></div>
                      <div class="d-flex justify-content-between">
                        <span class="bid">
                          Available Copies<br><strong><?= $book['availableCopies'] ?></strong><br>
                          <em><?= esc($book['genre']) ?></em>
                        </span>
                        <span class="ends">
                          Published<br><strong><?= esc($book['publishedYear']) ?></strong><br>
                          <em><?= esc($book['shelfLocation'] ?? 'Shelf N/A') ?></em>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p class="text-muted text-center">No books currently available.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>