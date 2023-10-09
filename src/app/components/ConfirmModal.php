<div id="confirmmodal" class="fullscreen centered modal">
    <div class="modal-content" style="max-width:300px;">
        <div class="modal-header">
            <h5 class="modal-title">Are you sure?</h5>
            <span id="close-confirm" class="close"
                onclick="document.getElementById('confirmmodal').style.display = 'none'";
            >&times;</span>
        </div>
        <p id="confirmation-msg" style="display: none;"></p>
        <form class="modal-body">
            <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                <button id="cancel-btn" type="button" class="btn btn-red circular-btn" style="flex:1"
                    onclick="document.getElementById('confirmmodal').style.display = 'none'";
                >No</button>
                <button id="confirm-btn" type="button" class="btn btn-yellow circular-btn" style="flex:1">Yes</button>
            </div>
        </form>
    </div>
</div>

<?php if(isset($message)) unset($message)?>;
