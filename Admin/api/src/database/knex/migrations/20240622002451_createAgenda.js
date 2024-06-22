/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.createTable('agenda', function(table) {
        table.increments('id').primary();
        table.integer('idMedico').notNullable();
        table.integer('idIdoso').notNullable();
        table.date('dataVisita').notNullable();
        table.time('horaVisita').notNullable();
        table.string('info', 200).notNullable();
        table.integer('IdVacina').notNullable();
        table.date('DataAplicacao').nullable();
        
        // Chaves estrangeiras
        // table.foreign('idMedico').references('id').inTable('medico');
        // table.foreign('idIdoso').references('id').inTable('idoso');
        // table.foreign('IdVacina').references('id').inTable('vacina');
      });
    
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
    return knex.schema.dropTableIfExists('agenda');
};
