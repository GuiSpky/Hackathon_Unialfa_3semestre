import config from '../../../knexfile.js'

import knex from 'knex'

const conexao = knex(config.development)

export default conexao