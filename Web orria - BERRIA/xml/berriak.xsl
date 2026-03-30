<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="sare-berriak">
            <xsl:for-each select="berriak/berria">

                <xsl:sort select="position()" data-type="number" order="descending" />
                
                <article
                    class="tarjeta-berria-grid">

                    <div class="imagen-berria-grid">
                        <img src="irudiak/berriak/{irudia}" alt="{tituloa}" />
                    </div>

                    <div class="texto-berria-grid">
                        <h3>
                            <xsl:value-of select="tituloa" />
                        </h3>

                        <p class="deskribapena-texto">
                            <xsl:value-of select="deskribapena" />
                        </p>

                        <div class="botoi-kaxa">
                            <a href="berria_ikusi.php?titulua={tituloa}" class="botoia-gehiago">Irakurri
        gehiago +</a>
                        </div>
                    </div>

                </article>

            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>