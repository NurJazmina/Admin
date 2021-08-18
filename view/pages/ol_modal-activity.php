<div class="modal fade" id="activity" tabindex="-1" role="dialog" aria-labelledby="activityTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add an activity or resource</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                <a class="btn d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_addassignment&Notes=<?= $Notes_id; ?>">
                    <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                        <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/handgiving.svg">
                    </div>
                    <div>Assignment</div>
                </a>
                </div>
            </div>
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                <a class="btn d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_modal-recheckquiz&Notes=<?= $Notes_id; ?>">
                    <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                        <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/quiz.svg">
                    </div>
                    <div>Quiz</div>
                </a>
                </div>
            </div>
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="btn d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_addsurvey&Notes=<?= $Notes_id; ?>" title="Add a new survey">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/survey.svg">
                        </div>
                        <div>Survey</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="btn d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_addannouncement&Notes=<?= $Notes_id; ?>" title="Add a new announcement">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/forum.svg">
                        </div>
                        <div>Announcement</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="btn d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_addurl&Notes=<?= $Notes_id; ?>" title="Add a new url">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/url.svg">
                        </div>
                        <div>URL</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="btn d-flex flex-column justify-content-between flex-fill" title="Add a new Chat">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon" aria-hidden="true" src="assets/media/svg/social-icons/chat.svg">
                        </div>
                        <div>Chat : Not available</div>
                    </a>
                </div>
            </div>
            <!--<div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="index.php?page=ol_addglossary&Notes=<?= $Notes_id; ?>" title="Add a new tool">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/glossary.svg">
                        </div>
                        <div>Glossary</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new book">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/book.svg">
                        </div>
                        <div>Book</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new choice">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/choice.svg">
                        </div>
                        <div>Choice</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new database">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/database.svg">
                        </div>
                        <div>Database</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new feedback">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/feedback.svg">
                        </div>
                        <div>Feedback</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new file">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/file.svg">
                        </div>
                        <div>File</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new folder">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/folder.svg">
                        </div>
                        <div>Folder</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new page">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/page.svg">
                        </div>
                        <div>Page</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1">
                <div class="card-body d-flex flex-column text-center p-1 mb-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new workshop">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/workshop.svg">
                        </div>
                        <div>Workshop</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 mb-1 mt-1 ">
                <div class="card-body d-flex flex-column text-center p-1 border">
                    <a class="d-flex flex-column justify-content-between flex-fill" href="" title="Add a new H5P">
                        <div class="optionicon mt-2 mb-1 icon-size-5 icon-no-margin">
                            <img class="icon icon" aria-hidden="true" src="assets/media/svg/social-icons/h5p.svg">
                        </div>
                        <div>H5P</div>
                    </a>
                </div>
            </div> -->
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>