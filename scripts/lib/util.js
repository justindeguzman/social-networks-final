
/*
 * Module dependencies.
 */

var request = require('request')
var _ = require('lodash')

function fetchLiveNodes (cb) {
  var url = 'http://admin.qmp/cgi-bin/bmx6-info?$neighbours=&_=0.7641213396564126'

  request({url: url, rejectUnauthorized: false, json: true},
    function (err, res, body) {
      if (err) {
        cb(err, null)
      } else {
        var nodes = body.neighbours[0].originators
        for (var i = 0; i < nodes.length; i++) {
          nodes[i].ip_address = nodes[i].primaryIp
          nodes[i] = _.pick(nodes[i], ['name', 'ip_address'])
          var nodeNum = parseNodeNumber(nodes[i].name)
          if (nodeNum) {
            nodes[i].node_number = nodeNum
          }
        }

        cb(null, nodes)
      }
    }
  )
}

function getNewNodes (old, current) {
  return _.difference(old, current)
}

function parseNodeNumber (str) {
  var tokens = str.split('-')

  if (tokens.length >= 3) {
    var num = tokens[tokens.length - 2]

    try {
      var nodeNum = parseInt(num, 10)
      return nodeNum
    } catch (e) {
      return null
    }
  }

  return null
}

/*
 * Module exports.
 */

exports.parseNodeNumber = parseNodeNumber
exports.fetchLiveNodes = fetchLiveNodes
exports.getNewNodes = getNewNodes
