# Add new sites which should only be available on staging URLs for now
# Note: remove location blocks from this file if moved to live.

location  ~ "^/(5388)(?:/.*)?$"  {
        include /etc/nginx/conf.d/proxy.inc;
        break;
}