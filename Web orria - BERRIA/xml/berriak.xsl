<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="w3-container">
            <xsl:for-each select="berriak/berria">
                <article class="w3-container w3-card-4 w3-round-large w3-margin-bottom w3-padding-16 w3-white">
                    <div class="w3-row">
                        <div class="w3-col m4">
                            <img src="irudiak/berriak/{irudia}" style="width:100%; border-radius:8px;"/>
                        </div>
                        <div class="w3-col m8 w3-padding">
                            <p><xsl:value-of select="deskribapena"/></p>
                            <a href="{esteka}" target="_blank" class="w3-button w3-text-red">Irakurri gehiago +</a>
                        </div>
                    </div>
                </article>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>