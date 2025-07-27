ARG image
FROM ${image}

COPY ./entrypoint.sh /entrypoint.sh

# For debug
RUN apk add --no-cache --virtual .build-deps \
    fcgi \
    iproute2;

RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]