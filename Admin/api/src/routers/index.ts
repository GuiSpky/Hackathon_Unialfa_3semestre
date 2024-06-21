import { Router } from 'express'
import usuario from './usuarios'
import agenda from './agenda'

const routes = Router()

routes.use('/usuario', usuario)
routes.use('/agenda', agenda)

export default routes
