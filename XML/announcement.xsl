<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : announcement.xsl
    Created on : March 29, 2022, 1:35 PM
    Author     : Oon Kheng Huang
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Announcement Category</title>
            </head>
            <body>
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="announcement">
        <table align="center" class="table table-hover">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Short Form</th>
                <th>Description</th>
            </tr>
            <xsl:for-each select="category">     
                <tr>
                    <td>
                        <xsl:value-of select="position()"/>
                    </td>
                    <td>
                        <xsl:value-of select="name"/>
                    </td>
                    <td>
                        <xsl:value-of select="shortForm"/>
                    </td>
                    <td>
                        <xsl:value-of select="description"/>
                    </td>   
                </tr>               
            </xsl:for-each>
        </table>
    </xsl:template>

</xsl:stylesheet>
