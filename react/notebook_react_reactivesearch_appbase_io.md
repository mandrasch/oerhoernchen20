
# Start

> npm start

# Build (now via webpack)

> npm run build

Afterwards: Copy oerhoerchen.community_bookmarks.js to codeigniter website

# Publish to github pages

> npm run deploy

-- 


https://medium.appbase.io/how-to-build-a-movie-search-app-with-react-and-elasticsearch-2470f202291c

> npx create-react-app oerhoernchen20-react

> cd oerhoernchen20-react
> npm start

> npm install @appbaseio/reactivesearch

https://medium.appbase.io/how-to-build-a-movie-search-app-with-react-and-elasticsearch-2470f202291c

https://codesandbox.io/s/github/appbaseio/reactivesearch/tree/next/packages/web/examples/ResultList?from-embed

https://github.com/babel/babel-sublime

See https://medium.appbase.io/how-to-build-a-movie-search-app-with-react-and-elasticsearch-2470f202291c for example of own list of data values

Add json loader:
https://stackoverflow.com/questions/31758081/loading-json-data-from-local-file-into-react-js

> Matthiass-Air:oerhoernchen20-react admin$ npm i json-loader --save

Add in react: 
> var data = require('json!../data/yourfile.json');

Github Pages deployment
https://codeburst.io/deploy-react-to-github-pages-to-create-an-amazing-website-42d8b09cd4d
> npm install --save gh-pages

>The “homepage” specifies the host path where you want to host the application. 
> The template for the URL is: 
> https://[your-user-name].github.io/[your-repo-name]/
> “predeploy” specifies the command to build before deployment.
> “deploy” specifies which branch and directory to deploy.

Run/Build:
> npm run deploy

# Bootstrap-react

https://react-bootstrap.netlify.com/getting-started/introduction

> npm install react-bootstrap bootstrap

#Webpack, to set public path

> npm install --save-dev webpack

change package.json

> "scripts": {
>   "start": "react-scripts start",
>  "build": "webpack",

> npm run build

Install webpack-cli 

# Webpack React starter

https://github.com/bradtraversy/react_webpack_starter

Required: 

> npm install --save-dev clean-webpack-plugin

Change webpackconfig because of bugs

Install babel, because loader cant be found when build

> npm install --save-dev @babel/core @babel/preset-env

> npm install --save-dev babel-loader

> npm install --save-dev css-loader

>npm install --save-dev @babel/preset-react

> npm install --save-dev file-loader

# Webpack copy file

> npm install copy-webpack-plugin --save-dev