FROM welaika/wordmove

COPY docker-entrypoint.sh /bin/updated-mount-ssh.sh
RUN chmod +x /bin/updated-mount-ssh.sh

ENTRYPOINT ["/bin/updated-mount-ssh.sh"]
