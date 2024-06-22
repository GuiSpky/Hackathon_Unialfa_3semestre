import { Router } from 'express'
import idosos from './idosos'
import agenda from './agenda'

const routes = Router()

routes.use('/idoso', idosos)
routes.use('/agenda', agenda)

export default routes
