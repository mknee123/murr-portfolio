ARG NODE_VERSION=${NODE_VERSION:-16}

FROM node:${NODE_VERSION:-16}-slim AS theme

WORKDIR /theme

RUN apt-get update && \
    apt-get install -y git libnotify-bin

CMD ["npm", "run", "watch"]
