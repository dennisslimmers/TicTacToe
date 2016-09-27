boardState = [0,0,0,0,0,0,0,0,0];
aiTurn = false;

function pushBoardState(id, e) {
    var page = 'passAjax.php';
    if (!aiTurn) {
        $("#"+ id).html("O");
        boardState[id - 1] = 1;
        aiTurn = true;
    }
    
    $.ajax({
        url: page,
        type: "post",
        data: {boardState:boardState, aiTurn: aiTurn},
        async: true,
        success: function (data) {
            var aiId = "";
            var aiMove = [];
            aiMove = data;

            makeMove(aiMove);
            setBoardStateToAiMove(aiMove, boardState);

            aiTurn = false;

            // console.log(boardState);
        }
    });

    e.preventDefault();
}

function makeMove(aiMove) {
    idsToCheck = [];
    aiId = "";

    for (var ii = 0; ii < aiMove.length; ii++) {
        if (aiMove[ii] == "2") {
            if ($("#"+ aiMove[ii]).html != "X") {
                idsToCheck.push(ii);
            }
        }
    }

    idsToCheck.forEach(function(id){
        var selector = $("#"+ id);

        if (selector.html != "X") {
            selector.html("X");
        }

        var index = idsToCheck.indexOf(id);

        if (index > -1) {
            idsToCheck.splice(index, 1);
        }
    });
}

function setBoardStateToAiMove(aiMove, boardState) {
    for (var ii = 0; ii < boardState.length; ii++) {
        boardState[ii - 1] = parseInt(aiMove[ii]);
    }
}


