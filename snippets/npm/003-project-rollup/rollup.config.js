import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import babel from '@rollup/plugin-babel';
import { terser } from "rollup-plugin-terser";

export default {
    input: 'src/index.js',
    output: [
        {
            sourcemap: true,
            file: 'public/assets/js/script.js',
            format: 'cjs'
        }
    ],
    plugins: [ 
        resolve({ignoreGlobal: false, include: ['node_modules/**']}), 
        commonjs(), 
        babel({ babelHelpers: 'bundled' }),
        terser()
    ]
};
