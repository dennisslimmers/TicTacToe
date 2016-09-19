boardState = [0,0,0,0,0,0,0,0,0];
aiTurn = false;

function pushBoardState(id, e) {
    var page = 'passAjax.php';
    if (aiTurn) {
        // TODO: This must not be done on a click event
        $("#"+ id).html("X");
        boardState[id - 1] = 2;
        aiTurn = false;
    } else {
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
            console.log(data);
            // document.write(data);
        }
    });

    e.preventDefault()
}
