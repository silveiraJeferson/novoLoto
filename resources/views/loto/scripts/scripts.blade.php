<script type="text/javascript">
    $(document).ready(function () {
        $(".button-collapse").sideNav();
        $('.modal').modal();

    });


    var acao;
    var id;
    function setId(id, acao) {
        document.getElementById('pergunta').innerHTML = "Deseja "+acao+ '?';
        document.getElementById("destroy").href = "/concurso/destroy/" + id;
    }

</script>