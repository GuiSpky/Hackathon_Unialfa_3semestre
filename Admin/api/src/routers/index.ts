import { Router } from 'express'
import usuario from './usuarios'

const routes = Router()

routes.use('/usuario', usuario)

export default routes
