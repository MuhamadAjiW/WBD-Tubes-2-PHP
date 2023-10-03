<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div id="content-header-rec" class="main-content first">
        <header class="home-header">
            <h1>Start Exploring</h1>
            <p>Here's what our reviewers think you should read this today</p>
            <p id="currentdate" style="color:#9b9b9b;text-align:right">date</p>
        </header>
        <!-- Template and randomize with hash on day -->
        <section class="book-rec">
            <div class="book-container">
                <img class="book-image" src="/storage/images/metamorphosis_cover.jpg">
                <!-- <img class="book-image" src="/storage/images/book_cover.jpeg"> -->
            </div>
            <div class="book-rec-desc">
                <p class="title-text">
                    The Metamorphosis
                </p>
                <p class="subtitle-text">
                    By Franz Kafka
                </p>
                <p class="desc-text">
                    Metamorphosis (German: Die Verwandlung) is a novella written by Franz Kafka which was first published in 1915. One of Kafka's best-known works, Metamorphosis tells the story of salesman Gregor Samsa, who wakes one morning to find himself inexplicably transformed into a huge insect (German: ungeheueres Ungeziefer, lit. "monstrous vermin") and subsequently struggles to adjust to this new condition. The novella has been widely discussed among literary critics, with differing interpretations being offered. In popular culture and adaptations of the novella, the insect is commonly depicted as a cockroach. With a length of about 70 printed pages over three chapters, it is the longest of the stories Kafka considered complete and published during his lifetime. The text was first published in 1915 in the October issue of the journal Die weißen Blätter under the editorship of René Schickele. The first edition in book form appeared in December 1915 in the series Der jüngste Tag, edited by Kurt Wolff.
                </p>
            </div>
        </section>
    </div>
    <div style="background-color:#f9f9f9">
        <!-- TODO: Implement pagination -->
        <div id="content-booklist" class="main-content">
            <h2>Book List</h1>
            <section class="book-list">
                <div class="book-container">
                    <!-- <img class="book-image" src="/storage/images/metamorphosis_cover.jpg"> -->
                    <!-- <img class="book-image" src="/storage/images/book_cover.jpeg"> -->
                </div>
            </section>
            <div>
                ceritanya pagination tapi belom diimplement
            </div>
        </div>
    </div>

    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
</body>

<script src="public/js/home.js"></script>
</html>


