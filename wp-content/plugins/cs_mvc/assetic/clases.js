/**
 * Created by pr0x on 13/06/2015.
 */
//creando las clases
function HC() {
    var self = this;
    this.id = ko.observable(1);
    this.acciones = ko.observableArray([]);
    this.accionesaplicadas = ko.observableArray([]);
    this.pruebas = ko.observableArray([]);
    this.planes = ko.observableArray([]);
    this.pruebasaplicadas = ko.observableArray([]);
    this.medicos = ko.observableArray([]);

    this.context_accionaplicada = ko.observable(new Plan({}));
    this.setAA = function(e) {
        if(e)
            self.context_accionaplicada(e);
        else self.context_accionaplicada(new Plan({}));
    };

    this.context_pruebaaplicada = ko.observable(new PruebaAplicada({}));
    this.setPA = function(e) {
        if(e)
            self.context_pruebaaplicada(e);
        else self.context_pruebaaplicada(new PruebaAplicada({}));
    };

    this.tpa = false;
    this.toggleAllPruebasAplicdas = function () {
        event.preventDefault();
        self.tpa = !self.tpa;
        jQuery.each(self.pruebasaplicadas(), function (i,e) {
            e.__details_visible(self.tpa);
        });
    }
}
function Prueba(p) {
    this.id = ko.observable(p.id);
    this.nombre = ko.observable(p.nombre);
    this.tipoprueba_id = ko.observable(p.tipoprueba_id);
    this.descripcion = ko.observable(p.descripcion);

    this.toString = function() {
        return this.nombre();
    }
}
function Accion(p) {
    this.id = ko.observable(p.id);
    this.nombre = ko.observable(p.nombre);
    this.descripcion = ko.observable(p.descripcion);
    this.tipoaccion_id = ko.observable(p.tipoaccion_id);
    this.tipo = ko.observable(p.tipo);

    this.toString = function() {
        return this.nombre();
    }
}
function User(p) {
    this.ID = ko.observable(p.ID);
    this.display_name = ko.observable(p.display_name);
    this.user_login = ko.observable(p.user_login);
    this.role = ko.observableArray([]);

    this.toString = function() {
        return this.display_name();
    }
}

function Plan(p) {
    var self = this;
    this.id = ko.observable(p.id);
    this.accion_id = ko.observable(p.accion_id);
    this.historia_id = ko.observable(p.historia_id);
    this.user_id = ko.observable(p.user_id);
    this.nombre = ko.observable(p.display_name);
    this.fecha_inicio = ko.observable(p.fecha_inicio);
    this.fecha_inicio_date = ko.observable(p.fecha_inicio_date);
    this.fecha_fin_date = ko.observable(p.fecha_fin_date);
    this.fecha_fin_time = ko.observable(p.fecha_fin_time);
    this.fecha_fin = ko.observable(p.fecha_fin);
    this.accion_nombre = ko.observable(p.accion_nombre);
    this.accion_descripcion = ko.observable(p.accion_descripcion);
    this.hc_nombre = ko.observable(p.hc_nombre);
    this.descripcion = ko.observable(p.descripcion);
    this.is_plan = ko.observable(p.is_plan);

    this.accion = ko.observable({});
    this.historia = ko.observable(hcViewModel);
    this.medico = ko.observable({});

    this.remove = function (e) {
        $.post(meta.ajax_url+'?controller=Plan.removeJSON', {id: e.id()}, function(response) {
            if(response.success) self.historia().accionesaplicadas.remove(e);
        });
    };
    this.save = function (e) {
        this.__clearCircle();
        $.post(meta.ajax_url+'?controller=Plan.saveJSON', ko.toJSON(e), function(response) {
            if(!e.id()) {
                e.id(response.id);
                e.historia().accionesaplicadas.unshift(e);
            }
            e.is_plan(response.is_plan);
        });
        this.__putCircle();
    };
    this.__clearCircle= function() {
        this.accion_id(this.accion().id());
        ko_temp_plan_accion = this.accion;
        this.accion = null;
        this.historia_id(this.historia().id());
        ko_temp_plan_historia = this.historia;
        this.historia = null;
        this.user_id(this.medico().ID());
        ko_temp_plan_medico = this.medico;
        this.medico = null;
    };
    this.__putCircle= function() {
        this.accion = ko_temp_plan_accion;
        this.historia = ko_temp_plan_historia;
        this.medico = ko_temp_plan_medico;
    };

}

function PruebaAplicada(p) {
    var self = this;
    this.id = ko.observable(p.id);
    this.prueba_id = ko.observable(p.prueba_id);
    this.historia_id = ko.observable(p.historia_id);
    this.user_id = ko.observable(p.user_id);
    this.fecha = ko.observable(p.fecha);
    this.fecha_date = ko.observable(p.fecha_date);
    this.fecha_time = ko.observable(p.fecha_time);
    this.prueba_nombre = ko.observable(p.prueba_nombre);
    this.prueba_descripcion = ko.observable(p.prueba_descripcion);
    this.hc_nombre = ko.observable(p.hc_nombre);
    this.descripcion = ko.observable(p.descripcion);
    this.resultados = ko.observable(p.resultados);

    this.prueba = ko.observable({});
    this.historia = ko.observable(hcViewModel);
    this.medico = ko.observable({});

    this.__details_visible = ko.observable(false);

    this.toggleDetails = function() {
        this.__details_visible(!this.__details_visible());
    }

    this.remove = function (e) {
        $.post(meta.ajax_url+'?controller=PruebaAplicada.removeJSON', {id: e.id()}, function(response) {
            if(response.success) self.historia().pruebasaplicadas.remove(e);
        });
    };
    this.save = function (e) {
        this.__clearCircle();
        $.post(meta.ajax_url+'?controller=PruebaAplicada.saveJSON', ko.toJSON(e), function(response) {
            if(!e.id()) {
                e.id(response.id);
                e.historia().pruebasaplicadas.unshift(e);
            }
        });
        this.__putCircle();
    };
    this.__clearCircle= function() {
        this.prueba_id(this.prueba().id());
        ko_temp_pa_prueba = this.prueba;
        this.prueba = null;
        this.historia_id(this.historia().id());
        ko_temp_pa_historia = this.historia;
        this.historia = null;
        this.user_id(this.medico().ID());
        ko_temp_pa_medico = this.medico;
        this.medico = null;
    };
    this.__putCircle= function() {
        this.prueba = ko_temp_pa_prueba;
        this.historia = ko_temp_pa_historia;
        this.medico = ko_temp_pa_medico;
    };
}
