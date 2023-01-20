import Welcome from './components/Welcome.vue'
import Board from './components/Board.vue'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'board',
        path: '/board',
        component: Board
    },
]