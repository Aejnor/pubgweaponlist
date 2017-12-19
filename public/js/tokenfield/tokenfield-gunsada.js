// Calibre
var calibre = new Bloodhound({
    local: [  {value: '45ACP'}, {value: '9mm'}, {value: '7.62mm'},{value: '5.56mm'},{value: '12 Gauge'},{value: 'Flecha'}],
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

calibre.initialize();

$('#inputCalibre').tokenfield({
    typeahead: [null, {
        source: calibre.ttAdapter(),
        displayKey: 'value' }]
});

// Tipo
var tipo = new Bloodhound({
    local: [ {value:"Primaria"}, {value:"Secundaria"},{value:"Melee"},{value:"Granada"}],
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

tipo.initialize();

$('#inputTipo').tokenfield({
    typeahead: [null, {
        source: tipo.ttAdapter(),
        displayKey: 'value' }]
});

// Retroceso
var retroceso = new Bloodhound({
    local: [ {value:"Bajo"},{value:"Mediano"},{value:"Alto"}],
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

retroceso.initialize();

$('#inputRetroceso').tokenfield({
    typeahead: [null, {
        source: retroceso.ttAdapter(),
        displayKey: 'value' }]
});