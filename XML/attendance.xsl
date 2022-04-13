<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : attendance.xsl
    Created on : April 13, 2022, 9:57 PM
    Author     : clhsk
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>attendance.xsl</title>
            </head>
            <body>
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="attendance">
        <table class="table table-hover " align="center">
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Description</th>
                <th>Safety Level</th>
            </tr>
            <xsl:for-each select="childTemperature">
                <tr>
                    <td>
                        <xsl:value-of select="position()"/>
                    </td>
                    <td>
                        <xsl:value-of select="code"/>
                    </td>
                    <td>
                        <xsl:value-of select = "description"/>
                    </td>
                    <td>
                        <xsl:value-of select = "safetyLevel"/>
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>

</xsl:stylesheet>
