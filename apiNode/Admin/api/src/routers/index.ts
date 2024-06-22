import { Router } from 'express'
import idosos from './idoso'
import agenda from './agenda'
import cuidador from './cuidador'

const routes = Router()

routes.use('/idoso', idosos)
routes.use('/agenda', agenda)
routes.use('/cuidador', cuidador)

export default routes
