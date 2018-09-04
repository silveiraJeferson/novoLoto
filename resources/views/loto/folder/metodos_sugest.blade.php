<h3>Apostas</h3>
<ul class="collapsible">
    <li>
        <div class="collapsible-header 90caf9 blue lighten-3"><i class="material-icons">call_made</i>Maior frequencia</div>
        <div class="collapsible-body e3f2fd blue lighten-5">  
            <span>
                <!--                ----------------------------formulario gerar mais frequentes-->
                <div class="row ">
                    <form class="col s12" method="post" action="/aposta/gerar-mais-frequentes">
                        <div class="row">

                            <div class="input-field col s4">
                                <input name="qtd_jogos" id="last_name" type="number" class="validate" required="required">
                                <label for="last_name">Quantidade de jogos</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="qtd_num"id="last_name" type="text" class="validate" value="15">
                                <label for="last_name">Quantidade de números</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="limite"id="last_name" type="text" class="validate" value="16">
                                <label for="last_name">Limite de números</label>
                            </div>
                            {!! csrf_field() !!}
                            <div class="input-field col s12">
                                <input class="btn" type="submit" value="Gerar">
                            </div>
                        </div>

                    </form>
                </div>
            </span>
        </div>
    </li>
    <li>
        <div class="collapsible-header f06292 pink lighten-2"><i class="material-icons">call_received</i>Menor frequencia</div>
        <div class="collapsible-body fce4ec pink lighten-5">
            <span>
                <!--                ----------------------------formulario gerar menos frequentes-->
                <div class="row ">
                    <form class="col s12" method="post" action="/aposta/gerar-menos-frequentes">
                        <div class="row">

                            <div class="input-field col s4">
                                <input name="qtd_jogos" id="last_name" type="number" class="validate" required="required">
                                <label for="last_name">Quantidade de jogos</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="qtd_num"id="last_name" type="text" class="validate" value="15">
                                <label for="last_name">Quantidade de números</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="limite"id="last_name" type="text" class="validate" value="16">
                                <label for="last_name">Limite de números</label>
                            </div>
                            {!! csrf_field() !!}
                            <div class="input-field col s12">
                                <input class="btn" type="submit" value="Gerar">
                            </div>
                        </div>

                    </form>
                </div>
            </span>
        </div>
    </li>
    <li>
        <div class="collapsible-header 7e57c2 deep-purple lighten-1"><i class="material-icons">expand_less</i><i class="material-icons">expand_more</i>Misto</div>

        <div class="collapsible-body d1c4e9 deep-purple lighten-4">
            <span>
                <div class="row">
                    <form class="col s12" method="post" action="/aposta/gerar-misto">
                        <div class="row">

                            <div class="input-field col s4">
                                <input name="qtd_jogos" id="last_name" type="number" class="validate" required="required">
                                <label for="last_name">Quantidade de jogos</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="qtd_num"id="last_name" type="text" class="validate" value="15">
                                <label for="last_name">Quantidade de números</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="limite"id="getRange" type="text" onblur="setRange()" class="validate" value="16">
                                <label for="last_name">Limite de números</label>
                            </div>

                            <div class="col s12">
                                <span id="range_left" class="left">Maior Frequencia: </span>
                                <input type="hidden" id="qtd_mais_freq" name="qtd_mais_freq" value=""/>

                                <span id="range_right" class="right">Menor Frequencia: </span>
                                <input type="hidden" id="qtd_menos_freq" name="qtd_menos_freq" value=""/>
                            </div>

                            <div class="input-field col s12">
                                <p class="range-field">
                                    <input id="tamanho" onmouseout="setValue()" type="range" id="test5" min="0"  max="15"/>
                                </p>
                            </div>

                            {!! csrf_field() !!}
                            <div class="input-field col s12">
                                <input class="btn" type="submit" value="Gerar">
                            </div>
                        </div>

                    </form>
                </div>

            </span>
        </div>
    </li>
</ul>

<!---------------------------------------apresenatção de resultados-->

<div class="row">
    @if(session()->has('mais_freq')? $mais_freq= session()->get('mais_freq'): null)
    <div class="col s4 fonte_peq">
        <ul class="collapsible popout">
            <li class="active">
                <div class="collapsible-header blue-grey darken-1"><i class="material-icons">filter_drama</i><h5>{{($mais_freq->metodo)}}<br/><span class="right" >{{count($mais_freq->jogos)}} jogos</span></h5></div>
                <div class="collapsible-body">
                    <span>
                        <div class="scroll">
                            @forelse($mais_freq->jogos as $jogo)
                            <div class="s6">
                                @foreach($jogo as $numero)
                                @if($numero < 10)
                                0{{$numero}}-
                                @else
                                {{$numero}}-
                                @endif

                                @endforeach
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </span>
                </div>
                <div class="card-action fonte_med">
                    <a href="/aposta/destroy/mais_freq">Descartar</a>
                    
                </div>
            </li>


        </ul>
    </div>
    @endif
    @if(session()->has('menos_freq')? $menos_freq= session()->get('menos_freq'): null)
    <div class="col s4 fonte_peq">
        <ul class="collapsible popout">
            <li class="active">
                <div class="collapsible-header blue-grey darken-1"><i class="material-icons">filter_drama</i><h5>{{($menos_freq->metodo)}}<br/><span class="right" >{{count($menos_freq->jogos)}} jogos</span></h5></div>
                <div class="collapsible-body">
                    <span>
                        <div class="scroll">
                            @forelse($menos_freq->jogos as $jogo)
                            <div class="s6">
                                @foreach($jogo as $numero)
                                @if($numero < 10)
                                0{{$numero}}-
                                @else
                                {{$numero}}-
                                @endif

                                @endforeach
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </span>
                </div>
                <div class="card-action">
                    <a href="/aposta/destroy/menos_freq">Descartar</a>
                    
                </div>
            </li>
        </ul>
    </div>
    @endif
    @if(session()->has('misto')? $misto= session()->get('misto'): null)
    <div class="col s4 fonte_peq">
        <ul class="collapsible popout">
            <li class="active">
                <div class="collapsible-header blue-grey darken-1"><i class="material-icons">filter_drama</i><h5>{{($misto->metodo)}}<br/><span class="right" >{{count($misto->jogos)}} jogos</span></h5></div>
                <div class="collapsible-body">
                    <span>
                        <div class="scroll">
                            @forelse($misto->jogos as $jogo)
                            <div class="s6">
                                @foreach($jogo as $numero)
                                @if($numero < 10)
                                0{{$numero}}-
                                @else
                                {{$numero}}-
                                @endif

                                @endforeach
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </span>
                </div>
                <div class="card-action">
                    <a href="/aposta/destroy/misto">Descartar</a>
                    
                </div>
            </li>
        </ul>
    </div>
    @endif
    <hr/>

    <div class="right">
        <a class="btn " href="/aposta/gerar-relatorio">Ver apostas</a>
    </div>
</div>













<script type="text/javascript">
    function setRange() {
        var range;
        range = document.getElementById('getRange').value;
        var input = document.getElementById('tamanho');
        input.setAttribute('max', range);


    }
    function setValue() {
        var input = document.getElementById('tamanho');
        var inputRange = document.getElementById('getRange').value;

        var range_left = document.getElementById('range_left');
        range_left.innerHTML = "Maior Frequencia: " + input.value;

        var range_right = document.getElementById('range_right');
        range_right.innerHTML = "Menor Frequencia: " + (inputRange - input.value);

        var qtd_mais_freq = document.getElementById('qtd_mais_freq');
        qtd_mais_freq.setAttribute('value', input.value);

        var qtd_menos_freq = document.getElementById('qtd_menos_freq');
        qtd_menos_freq.setAttribute('value', (inputRange - input.value));

    }


</script>
<!--<p class="range-field">
    <input type="range" id="test5" min="1" max="15" />
</p>-->