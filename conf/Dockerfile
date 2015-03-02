FROM        ubuntu:14.04
MAINTAINER  popomore "sakura9515@gmail.com"

ENV IOJS_VERSION 1.4.2

# Install dependencies
RUN apt-get update && apt-get install -y git \
    curl \
    nginx \
    supervisor
RUN git version
RUN nginx -v
RUN curl -V

# Install iojs
RUN gpg --keyserver pool.sks-keyservers.net --recv-keys 9554F04D7259F04124DE6B476D5A82AC7E37093B DD8F2338BAE7501E3DD5AC78C273792F7D83545D
RUN curl -SLO "https://iojs.org/dist/v$IOJS_VERSION/iojs-v$IOJS_VERSION-linux-x64.tar.gz" \
  && curl -SLO "https://iojs.org/dist/v$IOJS_VERSION/SHASUMS256.txt.asc" \
  && gpg --verify SHASUMS256.txt.asc \
  && grep " iojs-v$IOJS_VERSION-linux-x64.tar.gz\$" SHASUMS256.txt.asc | sha256sum -c - \
  && tar -xzf "iojs-v$IOJS_VERSION-linux-x64.tar.gz" -C /usr/local --strip-components=1 \
  && rm "iojs-v$IOJS_VERSION-linux-x64.tar.gz" SHASUMS256.txt.asc
RUN iojs -v

# Download site
RUN git clone https://github.com/popomore/chuome.git ~/site
WORKDIR /root/site
RUN npm install

RUN mkdir /root/log
RUN mkdir /root/conf
RUN mkdir /root/run
COPY nginx.conf /root/conf/nginx.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80 9001

CMD ["/usr/bin/supervisord"]
